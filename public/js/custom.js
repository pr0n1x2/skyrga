function getDataFromServerGet(url, data, callback, error) {
    getDataFromServer(url, 'GET', data, callback, error);
}

function getDataFromServerPost(url, data, callback, error) {
    getDataFromServer(url, 'POST', data, callback, error);
}

function getDataFromServer(url, type, data, callback, error) {
    $.ajax({
        url : url,
        type: type,
        data: data,
        dataType: 'json',
        success : callback,
        error: error
    });
}

var ComponentsDateTimePickers = function () {

    var handleDatePickers = function () {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true,
            weekStart: 1
        });
        //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
    }

    return {
        //main function to initiate the module
        init: function () {
            if (jQuery().datepicker) {
                handleDatePickers();
            }
        }
    };

}();

var TableDatatablesManaged = function () {

    var initUsersTable = function () {

        var table = $('#users_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ users",
                "infoEmpty": "No users found",
                "infoFiltered": "(filtered1 from _MAX_ total users)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching users found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            /*"columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],*/

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [6]
            }, {
                "searchable": false,
                "targets": [5, 6]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });
    }

    var initImagesTable = function () {

        var table = $('#images_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ images",
                "infoEmpty": "No images found",
                "infoFiltered": "(filtered1 from _MAX_ total images)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching images found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            /*"columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],*/

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [2, 3]
            }, {
                "searchable": false,
                "targets": [2, 3]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });
    }

    var initVideosTable = function () {

        var table = $('#videos_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ videos",
                "infoEmpty": "No videos found",
                "infoFiltered": "(filtered1 from _MAX_ total videos)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching videos found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            /*"columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],*/

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [3]
            }, {
                "searchable": false,
                "targets": [3]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });
    }

    var initGroupsTable = function () {

        var table = $('#groups_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ groups",
                "infoEmpty": "No groups found",
                "infoFiltered": "(filtered1 from _MAX_ total groups)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching groups found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            /*"columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],*/

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [2]
            }, {
                "searchable": false,
                "targets": [2]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });
    }

    var initMailAccountTable = function () {

        var table = $('#mail_accounts_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ mail accounts",
                "infoEmpty": "No mail accounts found",
                "infoFiltered": "(filtered1 from _MAX_ total mail accounts)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching mail accounts found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            /*"columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],*/

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [5]
            }, {
                "searchable": false,
                "targets": [4, 5]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });
    }

    var initPostsTable = function () {

        var table = $('#posts_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ posts",
                "infoEmpty": "No posts found",
                "infoFiltered": "(filtered1 from _MAX_ total posts)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching posts found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            /*"columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],*/

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [2]
            }, {
                "searchable": false,
                "targets": [2]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });
    }

    var initProfilesTable = function () {

        var table = $('#profiles_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ profiles",
                "infoEmpty": "No profiles found",
                "infoFiltered": "(filtered1 from _MAX_ total profiles)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching profiles found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            /*"columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],*/

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [3]
            }, {
                "searchable": false,
                "targets": [2, 3]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });
    }

    var initProjectsTable = function () {

        var table = $('#projects_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ projects",
                "infoEmpty": "No projects found",
                "infoFiltered": "(filtered1 from _MAX_ total projects)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching projects found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            /*"columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],*/

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [3]
            }, {
                "searchable": false,
                "targets": [2, 3]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });
    }

    var initProxiesTable = function () {

        var table = $('#proxies_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ proxies",
                "infoEmpty": "No proxies found",
                "infoFiltered": "(filtered1 from _MAX_ total proxies)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching proxies found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            /*"columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],*/

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [5]
            }, {
                "searchable": false,
                "targets": [5]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });
    }

    var initArticlesTable = function () {

        var table = $('#articles_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ articles",
                "infoEmpty": "No articles found",
                "infoFiltered": "(filtered1 from _MAX_ total articles)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching articles found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            /*"columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],*/

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [6]
            }, {
                "searchable": false,
                "targets": [6]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });
    }

    var initAuthorArticlesTable = function () {

        var table = $('#tasks_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ articles",
                "infoEmpty": "No articles found",
                "infoFiltered": "(filtered1 from _MAX_ total articles)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching articles found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            /*"columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],*/

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [6]
            }, {
                "searchable": false,
                "targets": [6]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            if ($('#users_table').length) {
                initUsersTable();
            }

            if ($('#images_table').length) {
                initImagesTable();
            }

            if ($('#videos_table').length) {
                initVideosTable();
            }

            if ($('#groups_table').length) {
                initGroupsTable();
            }

            if ($('#mail_accounts_table').length) {
                initMailAccountTable();
            }

            if ($('#posts_table').length) {
                initPostsTable();
            }

            if ($('#profiles_table').length) {
                initProfilesTable();
            }

            if ($('#projects_table').length) {
                initProjectsTable();
            }

            if ($('#proxies_table').length) {
                initProxiesTable();
            }

            if ($('#articles_table').length) {
                initArticlesTable();
            }

            if ($('#tasks_table').length) {
                initAuthorArticlesTable();
            }
        }

    };

}();

var FormValidation = function () {

    var userCreateValidation = function() {

        var form = $('#create_users_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                firstname: {
                    minlength: 2,
                    maxlength: 40,
                    required: true
                },
                lastname: {
                    minlength: 2,
                    maxlength: 40,
                    required: true
                },
                email: {
                    maxlength: 191,
                    email: true,
                    required: true
                },
                password: {
                    minlength: 6,
                    maxlength: 25,
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var userEditValidation = function() {

        var form = $('#edit_users_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                firstname: {
                    minlength: 2,
                    maxlength: 40,
                    required: true
                },
                lastname: {
                    minlength: 2,
                    maxlength: 40,
                    required: true
                },
                email: {
                    maxlength: 191,
                    email: true,
                    required: true
                },
                password: {
                    minlength: 6,
                    maxlength: 25,
                    required: false
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var imageValidation = function() {

        var form = $('#images_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                name: {
                    minlength: 3,
                    maxlength: 100,
                    required: true
                },
                url: {
                    url: true,
                    required: true
                },
                alt: {
                    maxlength: 3000,
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var videoValidation = function() {

        var form = $('#videos_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                name: {
                    minlength: 3,
                    maxlength: 100,
                    required: true
                },
                url: {
                    required: true,
                    maxlength: 191,
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var groupValidation = function() {

        var form = $('#groups_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                name: {
                    minlength: 2,
                    maxlength: 60,
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var mailAccountValidation = function() {

        var form = $('#mail_accounts_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                email: {
                    maxlength: 191,
                    email: true,
                    required: true
                },
                account_name: {
                    maxlength: 40,
                    required: true
                },
                password: {
                    maxlength: 25,
                    required: true
                },
                domain: {
                    maxlength: 70,
                    url: true,
                    required: true
                },
                login_page: {
                    maxlength: 191,
                    url: true,
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var postValidation = function() {

        var form = $('#posts_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                name: {
                    minlength: 2,
                    maxlength: 100,
                    required: true
                },
                title: {
                    required: true
                },
                text: {
                    required: true
                },
                anchor1: {
                    required: true
                },
                anchor2: {
                    required: true
                },
                anchor3: {
                    required: true
                },
                anchor4: {
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var profileValidation = function() {

        var form = $('#profiles_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                name: {
                    minlength: 2,
                    maxlength: 70,
                    required: true
                },
                domain: {
                    maxlength: 70,
                    url: true,
                    required: true
                },
                mail_account_id: {
                    required: true
                },
                group_id: {
                    required: true
                },
                business_name: {
                    minlength: 10,
                    maxlength: 140,
                    required: true
                },
                phone: {
                    minlength: 10,
                    maxlength: 20,
                    required: true
                },
                address1: {
                    minlength: 3,
                    maxlength: 60,
                    required: true
                },
                state: {
                    minlength: 3,
                    maxlength: 30,
                    required: true
                },
                state_shortcode: {
                    minlength: 2,
                    maxlength: 2,
                    required: true
                },
                city: {
                    minlength: 3,
                    maxlength: 40,
                    required: true
                },
                zip: {
                    minlength: 5,
                    maxlength: 10,
                    required: true
                },
                security_answer_mother: {
                    minlength: 3,
                    maxlength: 30,
                    required: true
                },
                security_answer_pet: {
                    minlength: 3,
                    maxlength: 30,
                    required: true
                },
                blog_name: {
                    required: true
                },
                about: {
                    required: true
                },
                anchor: {
                    required: true
                },
                main_anchor: {
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var projectValidation = function() {

        var form = $('#projects_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                name: {
                    minlength: 2,
                    maxlength: 70,
                    required: true
                },
                domain: {
                    maxlength: 70,
                    url: true,
                    required: true
                },
                register_page: {
                    maxlength: 191,
                    url: true,
                    required: true
                },
                login_page: {
                    maxlength: 191,
                    url: true,
                    required: true
                },
                paragraph_link: {
                    required: false,
                    number: true,
                    range: [1, 4]
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var proxyValidation = function() {

        var form = $('#proxies_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                ip: {
                    IP4Checker: true,
                    required: true
                },
                port: {
                    number: true,
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var profileValidation = function() {

        var form = $('#profile_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                firstname: {
                    minlength: 2,
                    maxlength: 40,
                    required: true
                },
                lastname: {
                    minlength: 2,
                    maxlength: 40,
                    required: true
                },
                email: {
                    maxlength: 191,
                    email: true,
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var passwordValidation = function() {

        var form = $('#password_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 25
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    maxlength: 25,
                    equalTo: "#password"
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var articleValidation = function() {

        var form = $('#articles_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                theme: {
                    minlength: 2,
                    maxlength: 191,
                    required: true
                },
                user_id: {
                    required: true
                },
                deadline: {
                    required: true,
                    date: true
                },
                price: {
                    required: true,
                    number: true
                },
                message: {
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            errorPlacement: function(error, element) {
                if (element.attr('name') == 'deadline') {
                    error.appendTo(element.parent().parent());
                } else {
                    error.appendTo(element.parent());
                }
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    var messageValidation = function() {

        var form = $('#messages_form');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                message: {
                    required: true,
                    maxlength: 5000
                }
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {

            if ($('#create_users_form').length) {
                userCreateValidation();
            }

            if ($('#edit_users_form').length) {
                userEditValidation();
            }

            if ($('#images_form').length) {
                imageValidation();
            }

            if ($('#videos_form').length) {
                videoValidation();
            }

            if ($('#groups_form').length) {
                groupValidation();
            }

            if ($('#mail_accounts_form').length) {
                mailAccountValidation();
            }

            if ($('#posts_form').length) {
                postValidation();
            }

            if ($('#profiles_form').length) {
                profileValidation();
            }

            if ($('#projects_form').length) {
                projectValidation();
            }

            if ($('#proxies_form').length) {
                proxyValidation();
            }

            if ($('#profile_form').length) {
                profileValidation();
            }

            if ($('#password_form').length) {
                passwordValidation();
            }

            if ($('#articles_form').length) {
                articleValidation();
            }

            if ($('#messages_form').length) {
                messageValidation();
            }
        }

    };

}();

var ModalsManaged = function () {

    var imageDeleting = function() {
        $('#delete').on('show.bs.modal', function (e) {
            var button = e.relatedTarget;
            $('#images_delete_form').attr('action', '/images/' + button.dataset.item);
        });
    }

    var imageShow = function() {
        var sendRequest = function(){
            $('.image-show').click(function () {
                getDataFromServerGet('/images/' + this.dataset.item, null, processData, null);
            })
        }

        var processData = function(image) {
            var el = $('#show');
            el.find('h4.modal-title').text(image.name);
            el.find('div.modal-body img').attr('src', image.url);
            el.find('div.note p').text(image.alt);

            $('#show').modal('show');
        }

        return {
            init: function () {
                sendRequest();
            }
        }
    }();

    var videoDeleting = function() {
        $('#delete').on('show.bs.modal', function (e) {
            var button = e.relatedTarget;
            $('#videos_delete_form').attr('action', '/videos/' + button.dataset.item);
        });
    }

    var videoShow = function() {
        var sendRequest = function(){
            $('.video-show').click(function () {
                getDataFromServerGet('/videos/' + this.dataset.item, null, processData, null);
            })
        }

        var processData = function(video) {
            var el = $('#show');
            el.find('h4.modal-title').text(video.name);
            el.find('div.modal-body iframe').attr('src', 'https://www.youtube.com/embed/' + video.url);

            $('#show').modal('show');
        }

        return {
            init: function () {
                sendRequest();
            }
        }
    }();

    var mainAccountShow = function() {
        var sendRequest = function(){
            $('.account-show').click(function () {
                getDataFromServerGet('/mail-accounts/' + this.dataset.item, null, processData, null);
            })
        }

        var processData = function(account) {
            $('#show_domain').attr('href', account.domain).text(account.domain);
            $('#show_email').text(account.email);
            $('#show_login').text(account.login);
            $('#show_password').text(account.password);
            $('#show_page').attr('href', account.page);

            $('#show').modal('show');
        }

        return {
            init: function () {
                sendRequest();
            }
        }
    }();

    var postDeleting = function() {
        $('#delete').on('show.bs.modal', function (e) {
            var button = e.relatedTarget;
            $('#posts_delete_form').attr('action', '/posts/' + button.dataset.item);
        });
    }

    var profileDeleting = function() {
        $('#delete').on('show.bs.modal', function (e) {
            var button = e.relatedTarget;
            $('#profiles_delete_form').attr('action', '/profiles/' + button.dataset.item);
        });
    }

    var projectDeleting = function() {
        $('#delete').on('show.bs.modal', function (e) {
            var button = e.relatedTarget;
            $('#projects_delete_form').attr('action', '/projects/' + button.dataset.item);
        });
    }

    var proxyDeleting = function() {
        $('#delete').on('show.bs.modal', function (e) {
            var button = e.relatedTarget;
            $('#proxies_delete_form').attr('action', '/proxies/' + button.dataset.item);
        });
    }

    var articleDeleting = function() {
        $('#delete').on('show.bs.modal', function (e) {
            var button = e.relatedTarget;
            $('#articles_delete_form').attr('action', '/articles/' + button.dataset.item);
        });
    }

    var articleCompleted = function() {
        var $modal = $('#send');

        var manage = function() {
            $('.article-send').click(function () {
                $modal.find('#article_id').val($(this).data('item'));
                $modal.modal();
            });
        }

        return {
            init: function () {
                manage();
            }
        }
    }();

    var articleRewrite = function() {
        var $modal = $('#rewrite');

        var manage = function() {
            $('#send_rewrite').bind('click', function () {
                $('#revision_date').val($modal.find('#deadline').val());
                $modal.modal('hide');
                $('#messages_form').submit();
            })
        }

        return {
            init: function () {
                manage();
            }
        }
    }();

    return {
        //main function to initiate the module
        init: function () {

            if ($('#images_delete_form').length) {
                imageDeleting();
            }

            if ($('#images_table').length) {
                imageShow.init();
            }

            if ($('#videos_delete_form').length) {
                videoDeleting();
            }

            if ($('#videos_table').length) {
                videoShow.init();
            }

            if ($('#mail_accounts_table').length) {
                mainAccountShow.init();
            }

            if ($('#posts_delete_form').length) {
                postDeleting();
            }

            if ($('#profiles_delete_form').length) {
                profileDeleting();
            }

            if ($('#projects_delete_form').length) {
                projectDeleting();
            }

            if ($('#proxies_delete_form').length) {
                proxyDeleting();
            }

            if ($('#articles_delete_form').length) {
                articleDeleting();
            }

            if ($('#articles_send_form').length) {
                articleCompleted.init();
            }

            if ($('#rewrite').length) {
                articleRewrite.init();
            }
        }

    };

}();

var Login = function() {

    var handleLogin = function() {

        var form = $('.login-form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                },
                remember: {
                    required: false
                }
            },

            messages: {
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('auth-has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('auth-has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('auth-has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                form.submit();
            }
        });

        $('.login-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    var handleForgetPassword = function() {
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },

            messages: {
                email: {
                    required: "Email is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
                form.submit();
            }
        });

        $('.forget-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        jQuery('#forget-password').click(function() {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function() {
            jQuery('.login-form').show();
            jQuery('.forget-form').hide();
        });

    }

    return {
        //main function to initiate the module
        init: function() {

            if ($('#login_form').length) {
                handleLogin();
                handleForgetPassword();
            }
        }

    };

}();

var MenuToggle = function() {

    var menu = function() {
        $('.menu-toggler').click(function () {
            getDataFromServerPost('/cookie', {name:'menu'}, null, null);
        })
    }

    return {
        //main function to initiate the module
        init: function() {
            menu();
        }

    };

}();

$.fn.bootstrapSwitch.defaults.onText = 'YES';
$.fn.bootstrapSwitch.defaults.offText = 'NO';
$.fn.bootstrapSwitch.defaults.offColor = 'danger';

$.validator.addMethod('IP4Checker', function(value) {
    var ip = "^(?!0)(?!.*\\.$)((1?\\d?\\d|25[0-5]|2[0-4]\\d)(\\.|$)){4}$";
    return value.match(ip);
}, 'Invalid IP address');

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        ComponentsDateTimePickers.init();
        TableDatatablesManaged.init();
        ModalsManaged.init();
        FormValidation.init();
        MenuToggle.init();
        Login.init();
    });
}
