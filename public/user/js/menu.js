var menu = function() {
    this.init = function() {
        $('.submenu').css('height', parseInt($('div.categories.list-group.border-shadow-bottom').css('height')) - 40);
        $('.submenu').css('left', $('.list-group-item.item-menu').css('width'));
    }
}
var menu = new menu();
menu.init();
