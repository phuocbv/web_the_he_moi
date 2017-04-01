var dttable = function() {

    this.table = null;

    this.init = function(tableName) {
        $(tableName).DataTable();
        var table = $(tableName).DataTable();
        this.table = table;
    }

    this.getTable = function() {
        return this.table;
    }
}
