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
            orientation: "auto",
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
                'targets': [4]
            }, {
                "searchable": false,
                "targets": [3, 4]
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

    var initAccountsTable = function () {

        var table = $('#accounts_table');

        // begin first table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ accounts",
                "infoEmpty": "No accounts found",
                "infoFiltered": "(filtered1 from _MAX_ total accounts)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching accounts found",
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

            if ($('#accounts_table').length) {
                initAccountsTable();
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
                gmail: {
                    required: true,
                },
                gmail_password: {
                    required: true,
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
                },
                proxy: {
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
                register_page: {
                    required: false,
                    maxlength: 191,
                    url: true
                },
                login_page: {
                    required: false,
                    maxlength: 191,
                    url: true
                },
                post_date: {
                    required: false,
                    number: true,
                    range: [1, 10]
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

    var userProfileValidation = function() {

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

    var targetsValidation = function() {

        var form = $('#targets_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                periodicity: {
                    required: true
                },
                date: {
                    required: true,
                    date: true
                },
                "profiles[]": "required"
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            errorPlacement: function(error, element) {
                if (element.attr('name') == 'date') {
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

    var hrefsValidation = function() {

        var form = $('#hrefs_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                site: {
                    required: true,
                    url: true
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

    var hrefsStatusValidation = function() {

        var form = $('#edit_hrefs_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
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
                var errorStatus = $('input[name=hrefs_status_id]:checked').val();

                if(errorStatus === undefined) {
                    return false;
                }

                form.submit();
            }
        });
    }

    var accountValidation = function() {

        var form = $('#accounts_form');
        var scrollTo = $('.portlet-title');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
            },
            rules: {
                mail_account_id: {
                    required: true
                },
                gender: {
                    required: true
                },
                username: {
                    required: true,
                    minlength: 5,
                    maxlength: 40,
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 25
                },
                firstname: {
                    required: true,
                    minlength: 3,
                    maxlength: 25
                },
                lastname: {
                    required: true,
                    minlength: 3,
                    maxlength: 25
                },
                prefix: {
                    required: true,
                    minlength: 2,
                    maxlength: 10
                },
                middlename: {
                    required: true,
                    minlength: 2,
                    maxlength: 25
                },
                birthday: {
                    required: true,
                    date: true
                },
                address1: {
                    required: true,
                    minlength: 3,
                    maxlength: 60
                },
                address2: {
                    minlength: 3,
                    maxlength: 60
                },
                state: {
                    required: true,
                    minlength: 3,
                    maxlength: 30
                },
                state_shortcode: {
                    required: true,
                    minlength: 2,
                    maxlength: 2
                },
                city: {
                    required: true,
                    minlength: 2,
                    maxlength: 40
                },
                zip: {
                    required: true,
                    minlength: 5,
                    maxlength: 10
                },
                phone: {
                    required: true,
                    minlength: 16,
                    maxlength: 20
                },
                domain_word: {
                    required: true,
                    minlength: 8,
                    maxlength: 40
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                App.scrollTo(scrollTo, 0);
            },

            errorPlacement: function(error, element) {
                if (element.attr('name') == 'birthday') {
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
                userProfileValidation();
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

            if ($('#targets_form').length) {
                targetsValidation();
            }

            if ($('#hrefs_form').length) {
                hrefsValidation();
            }

            if ($('#edit_hrefs_form').length) {
                hrefsStatusValidation();
            }

            if ($('#accounts_form').length) {
                accountValidation();
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
    }()

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
    }()

    var mainAccountShow = function() {
        var sendRequest = function(){
            $(document).on('click', '.account-show', function() {
                getDataFromServerGet('/mail-accounts/' + this.dataset.item, null, processData, null);
            });
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
    }()

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
    }()

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
    }()

    var reserveEmailChange = function() {
        var sendRequest = function(){
            var reserveElement;

            $(document).on('click', '.reserve_email_change', function() {
                reserveElement = $(this);
                getDataFromServerPost('/mail-accounts/get-reserve-emails', null, processData, null);
            });

            $('#reserve_email button.green').click(function () {
                var select = $('#reserve_email').find('select');

                if (select.val() == 0) {
                    return false;
                }

                getDataFromServerPost('/profile/set-reserve-email', {id: select.val(), profile_id: reserveElement.data('profile')}, null, null);

                var email = $('#reserve_email select option:selected').text();
                reserveElement.text(email);
                reserveElement.parent().find('a.account-show').attr('data-item', select.val());

                $('#reserve_email').modal('hide');
            });
        }

        var processData = function(emails) {
            var select = $('#reserve_email').find('select');

            select.empty().append('<option value="0">Select E-mail</option>');

            $.each(emails, function (id, email) {
                select.append('<option value="' + id + '">' + email + '</option>');
            })

            $('#reserve_email').modal('show');
        }

        return {
            init: function () {
                sendRequest();
            }
        }
    }()

    var setAccountPassword = function() {
        var sendRequest = function(){
            var passElement;

            $('.password-not-set').click(function () {
                passElement = $(this);
                $('#set_password').modal('show');
            });

            $('#set_password button.green').click(function () {
                var password = $('#set_password input').val();

                if (password.length === 0) {
                    return false;
                }

                getDataFromServerPost('/accounts/set-new-password', {id: passElement.data('item'), password: password}, null, null);

                passElement.removeClass('font-red').text(password.trim());
                $('#set_password input').val('');

                $('#set_password').modal('hide');
            });
        }

        return {
            init: function () {
                sendRequest();
            }
        }
    }()

    var deleteAccount = function() {
        var sendRequest = function(){
            var accountRow;
            var account;

            $('.target-remove').click(function () {
                account = $(this);
                accountRow = $(this).parent().parent().parent();

                $('#remove_target').modal('show');
            });

            $('#remove_target button.red').click(function () {
                getDataFromServerPost('/targets/remove', {id: account.data('item')}, processData, null);

                $('#remove_target').modal('hide');
            });

            var processData = function(tagret) {
                accountRow.find('.col2').remove();
                accountRow.find('.col3').remove();
                accountRow.find('.col4').remove();
                accountRow.find('.col5').remove();

                html = '<div class="col6">' +
                    '<div class="info">' +
                        '<i class="fa fa-envelope font-yellow-mint"></i> ' +
                        '<a href="javascript:;" class="email reserve_email_change" data-profile="' + tagret.profile_id + '">' + tagret.email + '</a> ' +
                        '<a href="javascript:;" class="account-show" data-item="' + tagret.id + '"><i class="fa fa-info-circle"></i></a>' +
                    '</div>' +
                '</div>';

                accountRow.append(html);
                accountRow.find('div.col1').find('div.label').removeClass('label-success').addClass('target-clickable');
            }
        }

        return {
            init: function () {
                sendRequest();
            }
        }
    }()

    var selectAccount = function() {
        var manager = function() {
            var previousAccount;

            $('.target-clickable').each(function() {
                if ($(this).hasClass('label-primary')) {
                    previousAccount = $(this);
                }
            });

            $(document).on('click', '.target-clickable', function() {
                if (previousAccount !== undefined) {
                    previousAccount.removeClass('label-primary');
                }

                previousAccount = $(this);
                $(this).addClass('label-primary');
                $('#target_id').val($(this).data('item'));
                selected = $(this).parent().parent().find('.desc').text();
                $('#target').find('span').text(selected.trim());
            });
        }

        return {
            init: function () {
                manager();
            }
        }
    }()

    var copyAccountInfo = function() {
        var manage = function(){

            $('.copy-data').click(function () {
                el = $(this);

                if (el.hasClass('copy-email')) {
                    data = el.parent().find('.email').text();
                    message = "E-mail has been copied to your clipboard.";
                } else if (el.hasClass('copy-username')) {
                    data = el.parent().find('span').text();
                    message = "Username has been copied to your clipboard.";
                } else if (el.hasClass('copy-password')) {
                    data = el.parent().find('span').text();
                    message = "Password has been copied to your clipboard.";
                }

                el = document.createElement('textarea');
                el.value = data;
                el.setAttribute('readonly', '');
                el.style.position = 'absolute';
                el.style.left = '-9999px';
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "1000",
                    "hideDuration": "1000",
                    "timeOut": "3000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                toastr.success(message);
            });
        }

        return {
            init: function () {
                manage();
            }
        }
    }()

    var linkAnalysis = function() {
        var manage = function(){
            var previousRadio = $('label.font-red-thunderbird');

            $('.copy-data').click(function () {
                var el = $(this);
                var data = el.parent().find('span').text();

                if (el.hasClass('copy-url')) {
                    data = window.location.protocol + '//' + window.location.hostname + /hrefs/ + data;
                    message = "Link url has been copied to your clipboard.";
                } else if (el.hasClass('copy-keyword')) {
                    message = "Keyword has been copied to your clipboard.";
                } else if (el.hasClass('copy-anchor')) {
                    message = "Anchor has been copied to your clipboard.";
                }

                el = document.createElement('textarea');
                el.value = data;
                el.setAttribute('readonly', '');
                el.style.position = 'absolute';
                el.style.left = '-9999px';
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "1000",
                    "hideDuration": "1000",
                    "timeOut": "3000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                toastr.success(message);
            });

            $('.radio-error').click(function () {
                if (previousRadio) {
                    previousRadio.removeClass('font-red-thunderbird');
                }

                $(this).addClass('font-red-thunderbird');
                previousRadio = $(this);
            });

            $('.font-green-jungle').click(function () {
                $('label.font-red-thunderbird').removeClass('font-red-thunderbird');
            });
        }

        return {
            init: function () {
                manage();
            }
        }
    }()

    var hrefsRemoving = function() {
        $('#delete').on('show.bs.modal', function (e) {
            var button = e.relatedTarget;
            $('#hrefs_delete_form').attr('action', '/hrefs/' + button.dataset.item);
        });
    }

    var accountsDeleting = function() {
        $('#delete').on('show.bs.modal', function (e) {
            var button = e.relatedTarget;
            $('#accounts_delete_form').attr('action', '/accounts/' + button.dataset.item);
        });
    }

    var targetsRegistration = function() {
        $('.copy-data').click(function () {
            var el = $(this);
            var field = el.data('field');
            var parent = el.parent();
            var copyElement = parent.find('a.editable-field');
            var message = null;
            var value = null;

            if (copyElement.length) {
                if (el.hasClass('copy-attr')) {
                    value = copyElement.attr('href');
                } else {
                    value = copyElement.text();
                }
            } else {
                value = parent.find('span.not_editable').text();
            }

            switch (field) {
                case 'domain': message = "Domain"; break;
                case 'regpage': message = "Register page"; break;
                case 'youtube': message = "YouTube link"; break;
                case 'email': message = "E-mail"; break;
                case 'username': message = "Username"; break;
                case 'password': message = "Password"; break;
                case 'prefix': message = "Prefix"; break;
                case 'gender': message = "Gender"; break;
                case 'firstname': message = "First name"; break;
                case 'lastname': message = "Last name"; break;
                case 'middlename': message = "Middle name"; break;
                case 'city': message = "City"; break;
                case 'address1': message = "Address 1"; break;
                case 'address2': message = "Address 2"; break;
                case 'state': message = "State"; break;
                case 'zip': message = "Zip code"; break;
                case 'phone': message = "Phone"; break;
                case 'domain_word': message = "Domain word"; break;
            }

            message = message + ' has been copied to your clipboard.';

            el = document.createElement('textarea');
            el.value = value;
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            toastr.success(message);
        });

        $('#username').editable();
        $('#password').editable();
        $('#firstname').editable();
        $('#lastname').editable();
        $('#middlename').editable();
        $('#city').editable();
        $('#address1').editable();
        $('#address2').editable();
        $('#zip').editable();
        $('#phone').editable();
        $('#domain_word').editable();

        $('#prefix').editable({
            title: 'Select Prefix',
            source: [{
                value: 'Mr.',
                text: 'Mr.'
            }, {
                value: 'Ms.',
                text: 'Ms.'
            }]
        });

        $('#gender').editable({
            title: 'Select Gender',
            source: [{
                value: 'male',
                text: 'male'
            }, {
                value: 'female',
                text: 'female'
            }]
        });

        $('#email').editable({
            url: '/post',
            title: 'Select E-mail',
            showbuttons: false
        });

        $('#state').editable({
            title: 'Select State',
            source: [{
                value: 'AL',
                text: 'Alabama'
            }, {
                value: 'AK',
                text: 'Alaska'
            }, {
                value: 'AZ',
                text: 'Arizona'
            }, {
                value: 'AR',
                text: 'Arkansas'
            }, {
                value: 'CA',
                text: 'California'
            }, {
                value: 'CO',
                text: 'Colorado'
            }, {
                value: 'CT',
                text: 'Connecticut'
            }, {
                value: 'DE',
                text: 'Delaware'
            }, {
                value: 'FL',
                text: 'Florida'
            }, {
                value: 'GA',
                text: 'Georgia'
            }, {
                value: 'HI',
                text: 'Hawaii'
            }, {
                value: 'ID',
                text: 'Idaho'
            }, {
                value: 'IL',
                text: 'Illinois'
            }, {
                value: 'IN',
                text: 'Indiana'
            }, {
                value: 'IA',
                text: 'Iowa'
            }, {
                value: 'KS',
                text: 'Kansas'
            }, {
                value: 'KY',
                text: 'Kentucky'
            }, {
                value: 'LA',
                text: 'Louisiana'
            }, {
                value: 'ME',
                text: 'Maine'
            }, {
                value: 'MD',
                text: 'Maryland'
            }, {
                value: 'MA',
                text: 'Massachusetts'
            }, {
                value: 'MI',
                text: 'Michigan'
            }, {
                value: 'MN',
                text: 'Minnesota'
            }, {
                value: 'MS',
                text: 'Mississippi'
            }, {
                value: 'MO',
                text: 'Missouri'
            }, {
                value: 'MT',
                text: 'Montana'
            }, {
                value: 'NE',
                text: 'Nebraska'
            }, {
                value: 'NV',
                text: 'Nevada'
            }, {
                value: 'NH',
                text: 'New Hampshire'
            }, {
                value: 'NJ',
                text: 'New Jersey'
            }, {
                value: 'NM',
                text: 'New Mexico'
            }, {
                value: 'NY',
                text: 'New York'
            }, {
                value: 'NC',
                text: 'North Carolina'
            }, {
                value: 'ND',
                text: 'North Dakota'
            }, {
                value: 'OH',
                text: 'Ohio'
            }, {
                value: 'OK',
                text: 'Oklahoma'
            }, {
                value: 'OR',
                text: 'Oregon'
            }, {
                value: 'PA',
                text: 'Pennsylvania'
            }, {
                value: 'RI',
                text: 'Rhode Island'
            }, {
                value: 'SC',
                text: 'South Carolina'
            }, {
                value: 'SD',
                text: 'South Dakota'
            }, {
                value: 'TN',
                text: 'Tennessee'
            }, {
                value: 'TX',
                text: 'Texas'
            }, {
                value: 'UT',
                text: 'Utah'
            }, {
                value: 'VT',
                text: 'Vermont'
            }, {
                value: 'VA',
                text: 'Virginia'
            }, {
                value: 'WA',
                text: 'Washington'
            }, {
                value: 'WV',
                text: 'West Virginia'
            }, {
                value: 'WI',
                text: 'Wisconsin'
            }, {
                value: 'WY',
                text: 'Wyoming'
            }]
        });
    }

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

            if ($('#mail_accounts_table').length || $('#target').length) {
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

            if ($('#target').length) {
                reserveEmailChange.init();
                setAccountPassword.init();
                deleteAccount.init();
                selectAccount.init();
                copyAccountInfo.init();
            }

            if ($('#edit_hrefs_form').length) {
                linkAnalysis.init();
            }

            if ($('#hrefs_delete_form').length) {
                hrefsRemoving();
            }

            if ($('#accounts_delete_form').length) {
                accountsDeleting();
            }

            if ($('#targets_register_form').length) {
                targetsRegistration();
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

$.fn.editable.defaults.mode = 'popup';
$.fn.editable.defaults.inputclass = 'form-control';

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