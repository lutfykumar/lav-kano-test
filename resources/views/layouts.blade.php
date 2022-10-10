<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Tester</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
        td,
        th {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="d-flex justify-content-center p-2">
            <h3 class="text-primary">Table List</h3>
        </div>
        <div class="row">
            <label class="col-sm-12 col-md-2 col-form-label"><span class="float-end">Filter Data :</span></label>
            <div class="col-sm-12 col-md-10 pt-1">
                <div class="row">
                    <div class="col"> <select class="form-select form-select-sm filter_company"
                            aria-label=".form-select-sm example" id="filter_company">
                            <option value="" selected>Choose One</option>
                        </select> </div>
                    <div class="col"> <select class="form-select form-select-sm filter_tier"
                            aria-label=".form-select-sm example" id="filter_tier">
                            <option value="" selected>Choose One</option>
                        </select> </div>
                    <div class="col"> <select class="form-select form-select-sm filter_segment"
                            aria-label=".form-select-sm example" id="filter_segment">
                            <option value="" selected>Choose One</option>
                        </select> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 table-responsive py-2">
                <table id="crudTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>CMGUnmaskedID</th>
                            <th>CMGUnmaskedName</th>
                            <th>ClientTier</th>
                            <th>GCPStream</th>
                            <th>GCPBusiness</th>
                            <th>CMGGlobalBU</th>
                            <th>CMGSegmentName</th>
                            <th>GlobalControlPoint</th>
                            <th>GCPGeography</th>
                            <th>GlobalRelationshipManagerName</th>
                            <th>REVENUE_FY14</th>
                            <th>REVENUE_FY15</th>
                            <th>Deposits_EOP_FY14</th>
                            <th>Deposits_EOP_FY15x</th>
                            <th>TotalLimits_EOP_FY14</th>
                            <th>TotalLimits_EOP_FY15</th>
                            <th>TotalLimits_EOP_FY15x</th>
                            <th>RWAFY15</th>
                            <th>RWAFY14</th>
                            <th>REV/RWA_FY14</th>
                            <th>REV/RWA_FY15</th>
                            <th>NPAT_AllocEq_FY14</th>
                            <th>NPAT_AllocEq_FY15X</th>
                            <th>Company_Avg_Activity_FY14</th>
                            <th>Company_Avg_Activity_FY15</th>
                            <th>ROE_FY14</th>
                            <th>ROE_FY15</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="modal_fullscreen">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="m_title">Default</h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
                <div class="modal-body" id="m_body">
                    <form id="m_form">
                        <input type="hidden" name="model_id" id="model_id" value="">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="fs-9">
                                    <span class="fw-bold">Client Tier :</span> <br>
                                    <span id="m_tier">-</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fs-9">
                                    <span class="fw-bold">Commercial Stream :</span> <br>
                                    <span id="m_GCPStream">-</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fs-9">
                                    <span class="fw-bold">Commercial Business :</span> <br>
                                    <span id="m_GCPBusiness">-</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fs-9">
                                    <span class="fw-bold">Business Category :</span> <br>
                                    <span id="m_CMGGlobalBU">-</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fs-9">
                                    <span class="fw-bold">Business Segment :</span> <br>
                                    <span id="m_CMGSegmentName">-</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fs-9">
                                    <span class="fw-bold">Country :</span> <br>
                                    <span id="m_GlobalControlPoint">-</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fs-9">
                                    <span class="fw-bold">World Region :</span> <br>
                                    <span id="m_GlobalControlPoint_b">-</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fs-9">
                                    <span class="fw-bold">Manager In Contact:</span> <br>
                                    <span id="m_GlobalRelationshipManagerName">-</span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-0">
                            <div class="col-sm-12 col-lg-3">
                                <div id="chart-pie"></div>
                            </div>
                            <div class="col-sm-12 col-lg-3">
                                <div id="chart-combi"></div>
                            </div>
                            <div class="col-sm-12 col-lg-3">
                                <div id="chart-line"></div>
                            </div>
                            <div class="col-sm-12 col-lg-3">
                                <div id="chart-column"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive py-2">
                                <table id="crudDetail" class="table table-bordered nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ROE_FY14</th>
                                            <th>ROE_FY15</th>
                                            <th>REVENUE_FY14</th>
                                            <th>REVENUE_FY15</th>
                                            <th>RWAFY14</th>
                                            <th>RWAFY15</th>
                                            <th>TotalLimits_EOP_FY14</th>
                                            <th>TotalLimits_EOP_FY15</th>
                                            <th>Company_Avg_Activity_FY14</th>
                                            <th>Company_Avg_Activity_FY15</th>
                                            <th>Deposits_EOP_FY14</th>
                                            <th>Deposits_EOP_FY15</th>
                                            <th>NPAT_AllocEq_FY14</th>
                                            <th>NPAT_AllocEq_FY15</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="input-group" style="width: 150px">
                                                    <input type="number" class="form-control" name="roe_14"
                                                        min="0" max="100" step="0.01"
                                                        placeholder="00.00" required value="">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" style="width: 150px">
                                                    <input type="number" class="form-control" name="roe_15"
                                                        min="0" max="100" step="0.01"
                                                        placeholder="00.00" required value="">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control mask-ribuan"
                                                    name="revenue_14" placeholder="000.000.000" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control mask-ribuan"
                                                    name="revenue_15" placeholder="000.000.000" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control mask-ribuan"
                                                    name="rwafy_14" placeholder="000.000.000" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control mask-ribuan"
                                                    name="rwafy_15" placeholder="000.000.000" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control mask-ribuan"
                                                    name="limit_14" placeholder="000.000.000" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control mask-ribuan"
                                                    name="limit_15" placeholder="000.000.000" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control mask-ribuan" name="avg_14"
                                                    placeholder="000.000.000" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control mask-ribuan" name="avg_15"
                                                    placeholder="000.000.000" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control mask-ribuan"
                                                    name="deposit_14" placeholder="000.000.000" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control mask-ribuan"
                                                    name="deposit_15" placeholder="000.000.000" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control mask-ribuan" name="npat_14"
                                                    placeholder="000.000.000" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control mask-ribuan" name="npat_15"
                                                    placeholder="000.000.000" required>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-12 d-flex justify-content-center mt-3">
                                <button type="button" class="btn btn-success btn-sm"
                                    id="btn-update">Re-Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const table = $('#crudTable');
        const modal = $('#modal_fullscreen');
        const m_title = modal.find('#m_title');
        const m_body = modal.find('#m_body');

        $(document).ready(function() {
            tableList();
            let f_company = '';
            let f_tier = '';
            let f_segment = '';

            $(".filter_company").change(function() {
                let val = $(this).val();
                f_company = val;
                table.DataTable().destroy();
                tableList(f_company, f_tier, f_segment);
                selectedFilter(f_company, f_tier, f_segment);
            });
            $(".filter_tier").change(function() {
                let val = $(this).val();
                f_tier = val;
                table.DataTable().destroy();
                tableList(f_company, f_tier, f_segment);
                selectedFilter(f_company, f_tier, f_segment);
            });
            $(".filter_segment").change(function() {
                let val = $(this).val();
                f_segment = val;
                table.DataTable().destroy();
                tableList(f_company, f_tier, f_segment);
                selectedFilter(f_company, f_tier, f_segment);
            });
        });

        $(document).on('click', '#btn-update', function() {
            let btn = $(this);
            let elm_form = $("#m_form");
            let formnya = elm_form[0];
            let dataForm = new FormData(formnya);
            btn.attr('disabled', true);
            $.ajax({
                url: "{{ route('update') }}",
                type: "POST",
                data: dataForm,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    console.log(res);
                    if (res.status == true) {
                        window.location.reload();
                    }
                    btn.attr('disabled', false);
                },
                error: function() {
                    alert('No Internet Koneksi');
                    btn.attr('disabled', false);
                }
            });
        });

        function tableList(company = '', tier = '', segment = '') {
            table.DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                ajax: {
                    method: 'POST',
                    url: "{{ route('table') }}",
                    data: {
                        company: company,
                        tier: tier,
                        segment: segment,
                    }
                },
                dom: "<'row'" +
                    "<'col-sm-12 col-md-12 align-items-center justify-content-sm-center justify-content-md-start'<'filter-custom row'>>" +
                    ">" +
                    "<tr>" +
                    "<'row'" +
                    "<'col-sm-12 col-md-8 d-flex align-items-center justify-content-center justify-content-md-start'li>" +
                    "<'col-sm-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10,
                language: {
                    'lengthMenu': 'Display _MENU_',
                },
                scrollX: true
            });
            $('#crudTable_info').addClass('p-0 ms-3');

            $(".filter_company").select2({
                placeholder: 'Search For CMGUnmaskedName',
                ajax: {
                    url: '{{ route('filter_company') }}',
                    type: "post",
                    dataType: 'JSON',
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
            $(".filter_tier").select2({
                placeholder: 'Search For ClientTier',
                ajax: {
                    url: '{{ route('filter_tier') }}',
                    type: "post",
                    dataType: 'JSON',
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
            $(".filter_segment").select2({
                placeholder: 'Search For CMGSegmentName',
                ajax: {
                    url: '{{ route('filter_segment') }}',
                    type: "post",
                    dataType: 'JSON',
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        }

        function selectedFilter(company = '', tier = '', segment = '') {
            $('#filter_company').select2('data', {
                id: company,
                text: company.replace('-', ' ')
            });
            $('#filter_tier').select2('data', {
                id: tier,
                text: tier.replace('-', ' ')
            });
            $('#filter_segment').select2('data', {
                id: segment,
                text: segment.replace('-', ' ')
            });
        }

        function showDetail(id, name) {
            m_title.text('Detail : ' + name + ' - ID : ' + id);
            let setData;
            $.ajax({
                url: "{{ route('detail') }}",
                type: "POST",
                dataType: 'JSON',
                data: {
                    id: id
                },
                // complete: function(data) {
                //     $('.mask-ribuan').each(function() {
                //         $(this).mask('000.000.000');
                //     });
                // },
                success: function(res) {
                    // console.log(res);
                    if (res.status == true) {
                        setData = res.data
                        m_body.find('#model_id').val(setData.CMGUnmaskedID).trigger('change');
                        m_body.find('#m_tier').text(setData.ClientTier);
                        m_body.find('#m_GCPStream').text(setData.GCPStream);
                        m_body.find('#m_GCPBusiness').text(setData.GCPBusiness);
                        m_body.find('#m_CMGGlobalBU').text(setData.CMGGlobalBU);
                        m_body.find('#m_CMGSegmentName').text(setData.CMGSegmentName);
                        m_body.find('#m_GlobalControlPoint').text(setData.GlobalControlPoint);
                        m_body.find('#m_GlobalControlPoint_b').text(setData.GlobalControlPoint);
                        m_body.find('#m_GlobalRelationshipManagerName').text(setData
                            .GlobalRelationshipManagerName);

                        let roe_14 = clearSpesialPersen(setData.ROE_FY14);
                        m_body.find('[name="roe_14"]').val(roe_14).trigger('change');

                        let roe_15 = clearSpesialPersen(setData.ROE_FY15);
                        m_body.find('[name="roe_15"]').val(roe_15).trigger('change');

                        m_body.find('[name="revenue_14"]').val(clearSpesial(setData.REVENUE_FY14)).trigger(
                            'change');
                        m_body.find('[name="revenue_15"]').val(clearSpesial(setData.REVENUE_FY15)).trigger(
                            'change');

                        m_body.find('[name="rwafy_14"]').val(clearSpesial(setData.RWAFY14)).trigger(
                            'change');
                        m_body.find('[name="rwafy_15"]').val(clearSpesial(setData.RWAFY15)).trigger(
                            'change');

                        m_body.find('[name="limit_14"]').val(clearSpesial(setData.TotalLimits_EOP_FY14))
                            .trigger(
                                'change');
                        m_body.find('[name="limit_15"]').val(clearSpesial(setData.TotalLimits_EOP_FY15))
                            .trigger(
                                'change');

                        m_body.find('[name="avg_14"]').val(clearSpesial(setData.Company_Avg_Activity_FY14))
                            .trigger(
                                'change');
                        m_body.find('[name="avg_15"]').val(clearSpesial(setData.Company_Avg_Activity_FY15))
                            .trigger(
                                'change');
                        m_body.find('[name="deposit_14"]').val(clearSpesial(setData.Deposits_EOP_FY14))
                            .trigger(
                                'change');
                        m_body.find('[name="deposit_15"]').val(clearSpesial(setData.Deposits_EOP_FY15x))
                            .trigger(
                                'change');

                        m_body.find('[name="npat_14"]').val(clearSpesial(setData.NPAT_AllocEq_FY14))
                            .trigger(
                                'change');
                        m_body.find('[name="npat_15"]').val(clearSpesial(setData.NPAT_AllocEq_FY15X))
                            .trigger(
                                'change');

                        FusionCharts.ready(function() {
                            let chartPie = new FusionCharts({
                                type: "pie2d",
                                renderAt: "chart-pie",
                                width: "100%",
                                height: "400",
                                dataFormat: "json",
                                dataSource: {
                                    chart: {
                                        caption: "ROE FY14 vs FY15",
                                        showlegend: "0",
                                        showValues: "0",
                                        showpercentvalues: "0",
                                        "showToolTip": "0",
                                        legendposition: "bottom",
                                        usedataplotcolorforlabels: "1",
                                        theme: "fusion"
                                    },
                                    data: [{
                                            label: "FY14",
                                            value: roe_14
                                        },
                                        {
                                            label: "FV15",
                                            value: roe_15
                                        },
                                    ]
                                }
                            }).render();
                            let chartCombi = new FusionCharts({
                                type: 'mscombidy2d',
                                renderAt: "chart-combi",
                                width: "100%",
                                height: "400",
                                dataFormat: 'json',
                                dataSource: {
                                    "chart": {
                                        "caption": "Renevue & RWA FY14 vs FY15",
                                        // "numberPrefix": "Rp ",
                                        "formatNumberScale": "0",
                                        "sNumberSuffix": "%",
                                        showValues: "0",
                                        showlegend: "0",
                                        "showToolTip": "0",
                                        "divlineAlpha": "100",
                                        "divlineColor": "#999999",
                                        "divlineThickness": "1",
                                        "divLineIsDashed": "1",
                                        "divLineDashLen": "1",
                                        "divLineGapLen": "1",
                                        "usePlotGradientColor": "0",
                                        "anchorRadius": "3",
                                        "theme": "fusion"
                                    },
                                    "categories": [{
                                        "category": [{
                                                "label": "RWA FY14"
                                            },
                                            {
                                                "label": "RENEVUE FY14"
                                            },
                                            {
                                                "label": "RWA FY15"
                                            },
                                            {
                                                "label": "RENEVUE FY15"
                                            }
                                        ]
                                    }],
                                    "dataset": [{
                                            "valueFontColor": "#ffffff",
                                            "valueBgColor": "#c23616",
                                            "data": [{
                                                "value": clearSpesial(setData
                                                    .RWAFY14)
                                            }, {
                                                "value": clearSpesial(setData
                                                    .REVENUE_FY14)
                                            }, {
                                                "value": clearSpesial(setData
                                                    .RWAFY15)
                                            }, {
                                                "value": clearSpesial(setData
                                                    .REVENUE_FY15)
                                            }]
                                        },
                                        {
                                            "seriesName": "Target",
                                            "renderAs": "line",
                                            "color": "00b5ad",
                                            "valueFont": "Arial",
                                            "valueFontColor": "#ffffff",
                                            "valueBgColor": "#00b5ad",
                                            "valueBgAlpha": "90",
                                            "plottooltext": "<b>$label</b> = <b>$dataValue</b>",
                                            "data": [{
                                                "value": clearSpesial(setData
                                                    .RWAFY14)
                                            }, {
                                                "value": clearSpesial(setData
                                                    .REVENUE_FY14)
                                            }, {
                                                "value": clearSpesial(setData
                                                    .RWAFY15)
                                            }, {
                                                "value": clearSpesial(setData
                                                    .REVENUE_FY15)
                                            }]
                                        },
                                    ]
                                }
                            }).render();
                            let chartCombiTwo = new FusionCharts({
                                type: 'line',
                                renderAt: "chart-line",
                                width: "100%",
                                height: "400",
                                dataFormat: 'json',
                                dataSource: {
                                    chart: {
                                        caption: "Total Limit EOP FY14 vs FY15",
                                        "formatNumberScale": "0",
                                        showValues: "0",
                                        showlegend: "0",
                                        "showToolTip": "0",
                                        theme: "fusion"
                                    },
                                    data: [{
                                            label: "TotalLimits_EOP_FY14",
                                            value: clearSpesial(setData
                                                .TotalLimits_EOP_FY14)
                                        },
                                        {
                                            label: "TotalLimits_EOP_FY15",
                                            value: clearSpesial(setData
                                                .TotalLimits_EOP_FY15)
                                        }
                                    ]
                                }
                            }).render();
                            let chartColumn = new FusionCharts({
                                type: "msbar2d",
                                renderAt: "chart-column",
                                width: "100%",
                                height: "400",
                                dataFormat: "json",
                                dataSource: {
                                    chart: {
                                        caption: "Company Average Activity FY14 vs FY15",
                                        placevaluesinside: "1",
                                        showvalues: "0",
                                        showlegend: "0",
                                        "showToolTip": "0",
                                        "formatNumberScale": "0",
                                        theme: "fusion"
                                    },
                                    categories: [{
                                        category: [{
                                                label: "Avg Regulatory Capital"
                                            },
                                            {
                                                label: "NPAT Allocation"
                                            },
                                            {
                                                label: "Total Limit EOP"
                                            },
                                            {
                                                label: "Deposits EOP"
                                            }
                                        ]
                                    }],
                                    dataset: [{
                                            seriesname: "FY14",
                                            data: [{
                                                    value: clearSpesial(setData
                                                        .Company_Avg_Activity_FY14)
                                                },
                                                {
                                                    value: clearSpesial(setData
                                                        .NPAT_AllocEq_FY14)
                                                },
                                                {
                                                    value: clearSpesial(setData
                                                        .TotalLimits_EOP_FY14)
                                                },
                                                {
                                                    value: clearSpesial(setData
                                                        .Deposits_EOP_FY14)
                                                }
                                            ]
                                        },
                                        {
                                            seriesname: "FY15",
                                            data: [{
                                                    value: clearSpesial(setData
                                                        .Company_Avg_Activity_FY15)
                                                },
                                                {
                                                    value: clearSpesial(setData
                                                        .NPAT_AllocEq_FY15X)
                                                },
                                                {
                                                    value: clearSpesial(setData
                                                        .TotalLimits_EOP_FY15)
                                                },
                                                {
                                                    value: clearSpesial(setData
                                                        .Deposits_EOP_FY15x)
                                                }
                                            ]
                                        }
                                    ]
                                }
                            }).render();
                        });
                    }
                },
                error: function(xhr) {
                    alert('Proses ambil data gagal. Coba lagi..')
                }
            });
            modal.on('shown.bs.modal', function() {
                setTimeout(() => {
                    // $('.mask-persen').each(function() {
                    //     $(this).mask('00.00');
                    // });
                    $('.mask-ribuan').each(function() {
                        $(this).mask('000.000.000');
                    });
                }, 3000);
            }).modal('show');
        }

        function clearSpesial(val) {
            if (val !== '') {
                let one = val.replace(',', '');
                let two = one.replace('.', '');
                if (isNaN(parseInt(two))) {
                    return 0;
                } else {
                    return parseInt(two);
                }
            }
        }

        function clearSpesialPersen(val) {
            if (val !== '') {
                let one = val.replace(',', '');
                let two = one.replace('%', '');
                if (isNaN(parseFloat(two))) {
                    return 0;
                } else {
                    return parseFloat(two).toFixed(1);
                }
            }
        }
    </script>
</body>

</html>
