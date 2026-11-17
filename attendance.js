$(function () {
    let attState = '';      // 'punch_in' | 'punch_out' | 'completed'
    let baseInfo = '';      // text shown below the date/time
    let clockTimer = null;
    let isBusy = false;     // true while a request is running
    let geo = {lat: '', lng: '', area: '', city: ''};
    // ---------- Device date / time helpers ----------
    function pad(n) {
        return String(n).padStart(2, '0');
    }
    // Returns the device's local date-time as "YYYY-MM-DD HH:mm:ss"
    function localDateTime() {
        const d = new Date();
        return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate()) + ' ' +
               pad(d.getHours()) + ':' + pad(d.getMinutes()) + ':' + pad(d.getSeconds());
    }
    function localDate() {
        return localDateTime().slice(0, 10);
    }
    function formatDateTime(d) {
        return d.toLocaleString('en-GB', {
            day: '2-digit', month: 'short', year: 'numeric',
            hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true
        });
    }
    // Live clock inside the modal
    function startClock() {
        stopClock();
        const tick = function () {
            $('#attDateTime').text(formatDateTime(new Date()));
        };
        tick();
        clockTimer = setInterval(tick, 1000);
    }
    function stopClock() {
        if (clockTimer) {
            clearInterval(clockTimer);
            clockTimer = null;
        }
    }
    // ---------- Message helpers (line below the clock) ----------
    function showInfo(msg) {
        $('#attInfo').removeClass('text-danger').addClass('text-muted').text(msg);
    }
    function showError(msg) {
        $('#attInfo').removeClass('text-muted').addClass('text-danger').text(msg);
    }
    function showLoading(msg) {
        $('#attInfo').removeClass('text-danger').addClass('text-muted')
            .html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>')
            .append(document.createTextNode(msg));
    }
    // ---------- Result modal (success / error) ----------
    function showResult(type, title, text) {
        const ok = (type === 'success');
        $('#attResultIcon')
            .removeClass('fa-check-circle text-success fa-times-circle text-danger')
            .addClass(ok ? 'fa-check-circle text-success' : 'fa-times-circle text-danger');
        $('#attResultTitle').text(title);
        $('#attResultText').text(text || '');
        $('#attResultModal').modal('show');
    }
    // ---------- Badge next to the "Attendance" link ----------
    function setBadge(state) {
        const $badge = $('#attBadge');
        if (state === 'punch_out') {            // punched in -> active
            $badge.text('Active').removeClass('badge-secondary').addClass('badge-success').show();
        } else if (state === 'completed') {     // punched out -> completed
            $badge.text('Completed').removeClass('badge-success').addClass('badge-secondary').show();
        } else {
            $badge.hide();
        }
    }
    // Show the current status when the page loads
    $.getJSON('attendance_action.php', {action: 'check', client_date: localDate()}, function (d) {
        setBadge(d.state);
    });
    // ---------- Modal ----------
    function resetModal() {
        $('#attActionBtn').show().prop('disabled', true).removeClass('btn-success btn-danger');
        $('#attCancelBtn').text('No').prop('disabled', false);
        $('#attModal .close').prop('disabled', false);
        $('#attQuestion').text('');
        $('#attDateTime').text('');
        showInfo('');
    }
    // Yes button: spinner + disabled while the request is running
    function setSubmitting(on) {
        const $yes = $('#attActionBtn');
        isBusy = on;
        if (on) {
            $yes.data('label', $yes.text())
                .prop('disabled', true)
                .html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>Processing...');
        } else {
            $yes.text($yes.data('label')).prop('disabled', false);
        }
        $('#attCancelBtn').prop('disabled', on);
        $('#attModal .close').prop('disabled', on);
    }
    $('#attendanceBtn').on('click', function (e) {
        e.preventDefault();
        if (isBusy) {
            return;                           // ignore clicks while a request is running
        }
        isBusy = true;
        $.getJSON('attendance_action.php', {action: 'check', client_date: localDate()})
            .done(function (d) {
                resetModal();
                if (d.state === 'punch_in') {
                    attState = 'punch_in';
                    baseInfo = '';
                    $('#attTitle').text('Punch In');
                    $('#attQuestion').text('Are you sure you want to punch in?');
                    $('#attActionBtn').text('Yes, Punch In').addClass('btn-success');
                    startClock();
                    $('#attModal').modal('show');
                    getLocation();
                } else if (d.state === 'punch_out') {
                    attState = 'punch_out';
                    baseInfo = 'Punched in at ' + d.in_time;
                    $('#attTitle').text('Punch Out');
                    $('#attQuestion').text('Are you sure you want to punch out?');
                    $('#attActionBtn').text('Yes, Punch Out').addClass('btn-danger');
                    startClock();
                    $('#attModal').modal('show');
                    getLocation();
                } else if (d.state === 'completed') {
                    attState = 'completed';
                    $('#attTitle').text('Attendance');
                    $('#attQuestion').text('Attendance completed for today');
                    showInfo('In: ' + d.in_time + '  |  Out: ' + d.out_time);
                    $('#attActionBtn').hide();
                    $('#attCancelBtn').text('Close');
                    $('#attModal').modal('show');
                } else {
                    showResult('error', 'Unable to continue', d.message || 'Something went wrong. Please try again.');
                }
            })
            .fail(function () {
                showResult('error', 'Unable to continue', 'Unable to check attendance status. Please try again.');
            })
            .always(function () {
                isBusy = false;
            });
    });
    $('#attModal').on('hidden.bs.modal', function () {
        stopClock();
    });
    // ---------- Location (saved with the punch, not displayed) ----------
    function locationReady() {
        showInfo(baseInfo);
        $('#attActionBtn').prop('disabled', false);
    }
    function getLocation() {
        showLoading('Fetching location...');
        if (!navigator.geolocation) {
            showError('Location is not supported by this browser.');
            return;
        }
        navigator.geolocation.getCurrentPosition(function (pos) {
            geo.lat = pos.coords.latitude;
            geo.lng = pos.coords.longitude;
            $.getJSON('https://nominatim.openstreetmap.org/reverse',
                {format: 'json', lat: geo.lat, lon: geo.lng, 'accept-language': 'en'},
                function (g) {
                    const a = g.address || {};
                    geo.area = a.suburb || a.neighbourhood || a.road || '';
                    geo.city = a.city || a.town || a.village || a.state_district || '';
                    locationReady();
                }
            ).fail(function () {
                geo.area = '';
                geo.city = '';
                locationReady();
            });
        }, function () {
            showError('Please allow location access to continue.');
        }, {enableHighAccuracy: true, timeout: 15000, maximumAge: 0});
    }
    // ---------- Confirm (Yes) ----------
    $('#attActionBtn').on('click', function () {
        if (isBusy) {
            return;                           // prevent double submit
        }
        const isPunchIn = (attState === 'punch_in');
        const punchTime = localDateTime();    // captured once, at the moment of confirmation
        setSubmitting(true);
        $.ajax({
            url: 'attendance_action.php',
            type: 'POST',
            dataType: 'json',
            timeout: 20000,
            data: {
                action: isPunchIn ? 'punchin' : 'punchout',
                client_datetime: punchTime,   // device date & time
                latitude: geo.lat,
                longitude: geo.lng,
                area: geo.area,
                city: geo.city
            }
        }).done(function (d) {
            if (d.success) {
                setBadge(isPunchIn ? 'punch_out' : 'completed');
                // Keep the buttons disabled until the modal is fully closed,
                // then show the success modal.
                $('#attModal').one('hidden.bs.modal', function () {
                    isBusy = false;
                    showResult(
                        'success',
                        isPunchIn ? 'Punched In Successfully' : 'Punched Out Successfully',
                        (isPunchIn ? 'Punch in time: ' : 'Punch out time: ') +
                            formatDateTime(new Date(punchTime.replace(' ', 'T')))
                    );
                });
                $('#attModal').modal('hide');
            } else {
                setSubmitting(false);
                showError(d.message || 'Request failed. Please try again.');
            }
        }).fail(function () {
            setSubmitting(false);
            showError('Request failed. Please check your attendance status and try again.');
        });
    });
});