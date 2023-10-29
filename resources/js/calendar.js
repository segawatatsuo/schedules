import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";

var calendarEl = document.getElementById("calendar");

let calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin],
    initialView: "dayGridMonth",
    locale: 'ja',
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "",
    },
});
calendar.render();