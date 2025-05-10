$(function () {
    "use strict";

    // Funcția pentru a permite rearanjarea cardurilor
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".card-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999,
    });

    // Setăm cursorul de tip 'move' pentru header-ul cardurilor
    $(".connectedSortable .card-header").css("cursor", "move");
});
