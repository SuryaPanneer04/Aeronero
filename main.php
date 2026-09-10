<!-- FullCalendar CSS -->
<link rel="stylesheet" href="plugins/fullcalendar/main.min.css">
<link rel="stylesheet" href="plugins/fullcalendar-daygrid/main.min.css">
<link rel="stylesheet" href="plugins/fullcalendar-timegrid/main.min.css">
<link rel="stylesheet" href="plugins/fullcalendar-bootstrap/main.min.css">

<section class="content" style="margin: 0; padding: 0;">
    <div class="container-fluid" id="main_content" style="position: relative; min-height: 85vh; overflow-x: hidden;">
        
        <!-- Background Image -->
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.15; z-index: 0; pointer-events: none; width: 100%; text-align: center;">
            <img src="login/assets/background_img.png" style="width: 80vw; max-width: 900px;" alt="background">
        </div>

        <!-- Sliding Calendar Panel (Fixed off-canvas style) -->
        <div id="calendarSlideWrapper" style="position: fixed; right: 0; top: 50%; z-index: 1050; display: flex; align-items: center; transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); transform: translate(550px, -50%);">
            
            <!-- Toggle Button -->
            <button onclick="toggleCalendar()" class="btn btn-primary shadow-lg" style="border-radius: 20px 0 0 20px; height: 60px; width: 35px; border: none; display: flex; align-items: center; justify-content: center; z-index: 10; cursor: pointer; box-shadow: -2px 0px 10px rgba(0,0,0,0.1);">
                <i id="calToggleArrow" class="fas fa-chevron-left" style="font-size: 16px;"></i>
            </button>

            <!-- Calendar Box -->
            <div class="shadow-lg" style="width: 550px; max-width: 85vw; background: rgba(255, 255, 255, 0.98); padding: 15px; border-radius: 15px 0 0 15px; border: 1px solid rgba(0, 158, 227, 0.2); border-right: none;">
                <div id="calendar"></div>
            </div>

        </div>

        <!-- Event Details Modal -->
        <div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 999999;">
          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0" style="border-radius: 10px; overflow: hidden;">
              <div class="modal-header border-0 text-white" id="eventModalHeader" style="background-color: #009EE3;">
                <h6 class="modal-title font-weight-bold"><i class="fas fa-user-clock mr-2"></i> Leave Details</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="outline:none;">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body bg-light" style="font-size: 14px;">
                <div class="mb-2"><strong>Employee:</strong> <span id="eventEmpName" class="text-primary"></span> <small class="text-muted">(<span id="eventEmpCode"></span>)</small></div>
                <!-- <div class="mb-2"><strong>Type:</strong> <span id="eventLeaveType" class="badge px-2 py-1"></span></div> -->
                <div class="mb-2"><strong>Duration:</strong> <span id="eventDuration" class="text-dark font-weight-bold"></span></div>
                <div class="mt-3 p-2 bg-white rounded border">
                    <small class="text-muted text-uppercase font-weight-bold d-block mb-1">Reason:</small>
                    <span id="eventReason"></span>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
</section>

<style>
/* Remove the old 240px margin logic since the menu is horizontal */
.content {
    max-width: 100% !important; 
    margin-left: 0 !important; 
}
#calendar {
    font-size: 12px; 
}
.fc-toolbar-title {
    font-size: 1.1em !important;
    color: #009EE3;
    font-weight: bold;
}
.fc-button {
    padding: 0.15rem 0.4rem !important;
    font-size: 0.8rem !important;
}
.fc-day-header {
    background-color: #f4f6f9;
    padding: 3px 0;
}
.fc-scroller {
    overflow-y: hidden !important;
}
.fc-event {
    cursor: pointer !important;
}
</style>

<!-- FullCalendar JS -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/fullcalendar/main.min.js"></script>
<script src="plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="plugins/fullcalendar-interaction/main.min.js"></script>
<script src="plugins/fullcalendar-bootstrap/main.min.js"></script>

<script>
  // Starts hidden
  var isCalendarOpen = false;

  function toggleCalendar() {
      var wrapper = document.getElementById('calendarSlideWrapper');
      var arrow = document.getElementById('calToggleArrow');
      
      if(isCalendarOpen) {
          // Hide it to the right
          wrapper.style.transform = 'translate(550px, -50%)';
          arrow.className = 'fas fa-chevron-left';
      } else {
          // Show it
          wrapper.style.transform = 'translate(0, -50%)';
          arrow.className = 'fas fa-chevron-right';
      }
      isCalendarOpen = !isCalendarOpen;
  }

  $(function () {
    var date = new Date();
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear();

    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
      plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      contentHeight: 380, // Compact size
      events    : 'get_dashboard_events.php', 
      editable  : false,
      droppable : false,
      eventClick: function(info) {
          var props = info.event.extendedProps;
          if(props.emp_name) {
              $('#eventEmpName').text(props.emp_name);
              $('#eventEmpCode').text(props.emp_code);
              
              $('#eventLeaveType').text(props.leave_type)
                                  .css({
                                      'background-color': info.event.backgroundColor, 
                                      'color': info.event.textColor
                                  });
              $('#eventModalHeader').css('background-color', info.event.backgroundColor);
              
              var startStr = moment(info.event.start).format('DD MMM YYYY');
              var endStr = info.event.end ? moment(info.event.end).subtract(1, 'days').format('DD MMM YYYY') : startStr;
              
              if(startStr == endStr) {
                  $('#eventDuration').text(startStr);
              } else {
                  $('#eventDuration').text(startStr + ' to ' + endStr);
              }
              
              $('#eventReason').text(props.reason || 'No reason provided');
              
              // Change cursor temporarily
              info.el.style.borderColor = 'black';
              
              $('#eventDetailsModal').modal('show');
          }
      }
    });

    calendar.render();
  });
</script>