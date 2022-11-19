$(document).ready(function(){
    var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events:'Controllers/Process.php?fetch=true',
        selectable:true,
        selectHelper:true,
        select:function(start,end,allDay){
            var title = prompt("Enter Event name");
            if(title){
                var start = $.fullCalendar.formatDate(start,"Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end,"Y-MM-DD HH:mm:ss");

                $.ajax({
                    url:'Controllers/Process.php',
                    type:'POST',
                    data:{
                        insert:true,
                        title:title,
                        start:start,
                        end:end
                    },
                    success:function(){
                        calendar.fullCalendar('refetchEvents');
                        alert("Added Event Successfully");
                    }
                })
            }
        },
        eventClick:function(event){
            if(confirm("Are you sure you want to delete this event?")){
                var id = event.id;

                $.ajax({
                    url:'Controllers/Process.php',
                    method:'POST',
                    data:{delete:true,id:id},
                    success: function(){
                        calendar.fullCalendar('refetchEvents');
                        alert("Event got deleted!");
                    }
                })
            }
        },
        eventResize:function(event){
            var start = $.fullCalendar.formatDate(event.start,"Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end,"Y-MM-DD HH:mm:ss");

            var title = event.title;
            var id = event.id;

            $.ajax({
                url:'Controllers/Process.php',
                method:'POST',
                data:{
                    update:true,
                    title:title,
                    start:start,
                    end:end,
                    id:id
                },
                success:function(){
                    calendar.fullCalendar("refetchEvents");
                    alert("Event moved to another date!");
                }
            })
        },
        eventDrop:function(event){
            var start = $.fullCalendar.formatDate(event.start,"Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end,"Y-MM-DD HH:mm:ss");

            var title = event.title;
            var id = event.id;

            $.ajax({
                url:'Controllers/Process.php',
                method:'POST',
                data:{
                    update:true,
                    title:title,
                    start:start,
                    end:end,
                    id:id
                },
                success:function(){
                    calendar.fullCalendar("refetchEvents");
                    alert("Event moved to another date!");
                }
            })
        }
    })
})
