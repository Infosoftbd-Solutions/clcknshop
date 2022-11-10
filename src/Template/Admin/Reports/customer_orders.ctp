
<script>
    require.config({
        shim: {
            'flatpickr': ['jquery']
        },
        paths: {
            'flatpickr': 'assets/js/vendors/flatpickr.min'
        }
    });
</script>

    <div class="row">
        <div class="col-12 d-flex justify-content-between pb-5">
            <div class="title">
                <h2 class="pl-3 page-title">
                <?= __('Customer Orders Reports') ?>
                </h2>
            </div>

            <div class="filter-action pr-3">
                <div class="input-group">
                    <div class="input-icon d-inline-block">
                        <input id="filter_range" type="text" value="2020-06-20" class="form-control flatpickr-input calendar-range" placeholder="<?= __('Select a date') ?>" readonly="readonly">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                <line x1="16" y1="3" x2="16" y2="7"></line>
                                <line x1="8" y1="3" x2="8" y2="7"></line>
                                <line x1="4" y1="11" x2="20" y2="11"></line>
                                <line x1="11" y1="15" x2="12" y2="15"></line>
                                <line x1="12" y1="15" x2="12" y2="18"></line>
                            </svg>
                        </span>
                    </div>
                    <div class="input-group-append">
                        <button type="button" id="search" class="btn btn-primary"><i class="fe fe-search"></i></button>
<!--                        <button type="button" class="btn btn-outline-secondary">Daily</button>-->
<!--                        <button type="button" class="btn btn-outline-secondary">weekly</button>-->
<!--                        <button type="button" class="btn btn-outline-secondary">Monthly</button>-->
<!--                        <button type="button" class="btn btn-outline-secondary">Yearly</button>-->
                        <button id="print" type="button" class="btn btn-outline-secondary">
                            <i class="fe fe-printer"></i>
                            <?= __('Print')?>
                        </button>
                        <button id="export" type="button" class="btn btn-outline-secondary">
                            <i class="fe fe-download"></i>
                            <?= __('Export') ?> 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="col-12">
    <div id="content"></div>
</div>

<script>

    require(['jquery', 'flatpickr'], function ($, selectize) {
        $(document).ready(function () {
            $("#print").click(function(){
                //window.print();
                var head = $("head").html();
                var content = $("#content").html();
                var src = "<html> <head>" + head +'</head> <body><div class="row">' + content + '</div></body></html>';
                var w = window.open()
                w.document.write(src);
                setTimeout(() =>{
                    w.window.print();
                    w.window.close();
                },500)

            })

            $(".calendar-range").flatpickr({
                mode: "range",
                dateFormat: "d-m-Y",
                defaultDate: [last_date(15), new Date()]
            })

            $("#search").click(function (e) {
                filter();
            });

            $("#export").click((e) => {
                let range = $("#filter_range").val();
                let routeUrl = "<?= $this->Url->build(['controller' => 'Reports', 'action' => 'customerOrdersReports']) ?>/"+encodeURIComponent(range) + '/1';
                $.ajax({
                    url: routeUrl,
                    type: 'GET',
                    // dataType: 'json', // added data dtype
                    success: function (response) {
                        setTimeout(() =>{
                            $("#content").html(response);
                        },500)
                    }
                });
            })

            function last_date(days) {
                var date = new Date();
                return date.setDate(date.getDate() - days)
            }

            function filter() {
                $("#content").html(placeholder())
                let range = $("#filter_range").val();
                let routeUrl = "<?= $this->Url->build(['controller' => 'Reports', 'action' => 'customerOrdersReports']) ?>/"+encodeURIComponent(range);
                $.ajax({
                    url: routeUrl,
                    type: 'GET',
                    // dataType: 'json', // added data dtype
                    success: function (response) {
                        setTimeout(() =>{
                            $("#content").html(response);
                        },500)
                    }
                });
            }

            filter();
            function placeholder(loop_limit =5){
                let ph = '';
                let row = '';
                for (var i = 1; i<= loop_limit; i++) row += '<div class="ph-col-12 big"></div>';

                ph += '<div class="card">'
                ph += '<div class="ph-item" style="border: none">'
                ph += '<div class="ph-col-12">'
                ph += '<div class="ph-row">'
                ph += '<div class="ph-col-12 big" style="height: 35px"></div>'
                ph += '</div>'
                ph += '<div class="ph-row">'
                ph += row
                ph += '</div>'
                ph += '</div>'
                ph += '</div'
                ph += '</div>'

                return ph;
            }

        });
    });


</script>
