$(document).ready(function () {
    handleActiveLinks();
    handleAddRoom()
})

const handleActiveLinks = () => {
    // i = index
    // v = value
    const allLinks = $('a')
    allLinks.each((i,v) => {
        const href = v.href
        const currentHref = window.location.href;
        if (href === currentHref) {
            $(v).addClass('active')
        } else {
            $(v).removeClass('active')
        }
    })
}

const handleAddRoom = () => {
    const roomsTable = $('.table.rooms')
    const addRoomSection = $('#addRoom-section')
    const addRoomBtn = $('#addRoom');
    const closeRoomBtn = $('#addRoom-close')

    addRoomBtn.click(function () {
        addRoomSection.attr('class', 'active')
        roomsTable.addClass('hidden')
    })

    closeRoomBtn.click(function (e) {
        e.preventDefault()
        closeAddRoomSection()
    })

    const closeAddRoomSection = () => {
        addRoomSection.attr('class','hidden')
        showRoomsTable()
    }
    const showRoomsTable = () => {
        roomsTable.removeClass('hidden')
    }
}
