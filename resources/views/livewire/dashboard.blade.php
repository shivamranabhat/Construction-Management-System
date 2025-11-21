<div>
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div>
            <h4 class="mb-0">Hi {{ Auth::user()->name }}, welcome back!</h4>
            <p class="mb-0 text-muted">Monitor your overall project logs.</p>
        </div>

    </div> <!-- End Page Header -->
    <!-- row -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="px-3 pt-3  pb-2 pt-0">
                    <div>
                        <h6 class="mb-3 fs-12 text-fixed-white">TODAY ORDERS</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div>
                                <h4 class="fs-20 fw-bold mb-1 text-fixed-white">$174.12</h4>
                                <p class="mb-0 fs-12 text-fixed-white op-7">Compared to last week</p>
                            </div> <span class="float-end my-auto ms-auto"> <i
                                    class="fas fa-arrow-circle-up text-fixed-white"></i> <span
                                    class="text-fixed-white op-7"> +4</span> </span>
                        </div>
                    </div>
                </div>
                <div id="compositeline" style="min-height: 30px;">
                    <div id="apexchartswpy84lg6" class="apexcharts-canvas apexchartswpy84lg6 apexcharts-theme-light"
                        style="width: 296px; height: 30px;"><svg id="SvgjsSvg2735" width="296" height="30"
                            xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS"
                            transform="translate(0, 0)" style="background: transparent;">
                            <foreignObject x="0" y="0" width="296" height="30">
                                <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"
                                    style="max-height: 15px;"></div>
                            </foreignObject>
                            <rect id="SvgjsRect2739" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1"
                                stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                            <g id="SvgjsG2794" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                            <g id="SvgjsG2737" class="apexcharts-inner apexcharts-graphical"
                                transform="translate(0, 0)">
                                <defs id="SvgjsDefs2736">
                                    <clipPath id="gridRectMaskwpy84lg6">
                                        <rect id="SvgjsRect2741" width="302" height="32" x="-3" y="-1" rx="0" ry="0"
                                            opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                        </rect>
                                    </clipPath>
                                    <clipPath id="forecastMaskwpy84lg6"></clipPath>
                                    <clipPath id="nonForecastMaskwpy84lg6"></clipPath>
                                    <clipPath id="gridRectMarkerMaskwpy84lg6">
                                        <rect id="SvgjsRect2742" width="300" height="34" x="-2" y="-2" rx="0" ry="0"
                                            opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                        </rect>
                                    </clipPath>
                                    <linearGradient id="SvgjsLinearGradient2747" x1="0" y1="0" x2="0" y2="1">
                                        <stop id="SvgjsStop2748" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)"
                                            offset="0"></stop>
                                        <stop id="SvgjsStop2749" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)"
                                            offset="1"></stop>
                                        <stop id="SvgjsStop2750" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)"
                                            offset="1"></stop>
                                    </linearGradient>
                                </defs>
                                <line id="SvgjsLine2740" x1="0" y1="0" x2="0" y2="30" stroke="#b6b6b6"
                                    stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0"
                                    y="0" width="1" height="30" fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                    stroke-width="1"></line>
                                <g id="SvgjsG2753" class="apexcharts-grid">
                                    <g id="SvgjsG2754" class="apexcharts-gridlines-horizontal" style="display: none;">
                                        <line id="SvgjsLine2757" x1="0" y1="0" x2="296" y2="0" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2758" x1="0" y1="3" x2="296" y2="3" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2759" x1="0" y1="6" x2="296" y2="6" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2760" x1="0" y1="9" x2="296" y2="9" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2761" x1="0" y1="12" x2="296" y2="12" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2762" x1="0" y1="15" x2="296" y2="15" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2763" x1="0" y1="18" x2="296" y2="18" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2764" x1="0" y1="21" x2="296" y2="21" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2765" x1="0" y1="24" x2="296" y2="24" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2766" x1="0" y1="27" x2="296" y2="27" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2767" x1="0" y1="30" x2="296" y2="30" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                    </g>
                                    <g id="SvgjsG2755" class="apexcharts-gridlines-vertical" style="display: none;">
                                    </g>
                                    <line id="SvgjsLine2769" x1="0" y1="30" x2="296" y2="30" stroke="transparent"
                                        stroke-dasharray="0" stroke-linecap="butt"></line>
                                    <line id="SvgjsLine2768" x1="0" y1="1" x2="0" y2="30" stroke="transparent"
                                        stroke-dasharray="0" stroke-linecap="butt"></line>
                                </g>
                                <g id="SvgjsG2756" class="apexcharts-grid-borders" style="display: none;"></g>
                                <g id="SvgjsG2743" class="apexcharts-area-series apexcharts-plot-series">
                                    <g id="SvgjsG2744" class="apexcharts-series" seriesName="Value"
                                        data:longestSeries="true" rel="1" data:realIndex="0">
                                        <path id="SvgjsPath2751"
                                            d="M 0 30 L 0 21.666666666666668 L 15.578947368421053 15.000000000000002 L 31.157894736842106 21.666666666666668 L 46.73684210526316 20 L 62.31578947368421 23.333333333333336 L 77.89473684210526 10.000000000000004 L 93.47368421052632 3.552713678800501e-15 L 109.05263157894737 6.666666666666671 L 124.63157894736842 13.333333333333336 L 140.21052631578948 5.0000000000000036 L 155.78947368421052 10.000000000000004 L 171.3684210526316 21.666666666666668 L 186.94736842105263 16.666666666666668 L 202.5263157894737 21.666666666666668 L 218.10526315789474 10.000000000000004 L 233.6842105263158 21.666666666666668 L 249.26315789473685 10.000000000000004 L 264.8421052631579 13.333333333333336 L 280.42105263157896 3.3333333333333357 L 296 10.000000000000004 L 296 30M 296 10.000000000000004z"
                                            fill="url(#SvgjsLinearGradient2747)" fill-opacity="1" stroke-opacity="1"
                                            stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                            class="apexcharts-area" index="0" clip-path="url(#gridRectMaskwpy84lg6)"
                                            pathTo="M 0 30 L 0 21.666666666666668 L 15.578947368421053 15.000000000000002 L 31.157894736842106 21.666666666666668 L 46.73684210526316 20 L 62.31578947368421 23.333333333333336 L 77.89473684210526 10.000000000000004 L 93.47368421052632 3.552713678800501e-15 L 109.05263157894737 6.666666666666671 L 124.63157894736842 13.333333333333336 L 140.21052631578948 5.0000000000000036 L 155.78947368421052 10.000000000000004 L 171.3684210526316 21.666666666666668 L 186.94736842105263 16.666666666666668 L 202.5263157894737 21.666666666666668 L 218.10526315789474 10.000000000000004 L 233.6842105263158 21.666666666666668 L 249.26315789473685 10.000000000000004 L 264.8421052631579 13.333333333333336 L 280.42105263157896 3.3333333333333357 L 296 10.000000000000004 L 296 30M 296 10.000000000000004z"
                                            pathFrom="M -1 30 L -1 30 L 15.578947368421053 30 L 31.157894736842106 30 L 46.73684210526316 30 L 62.31578947368421 30 L 77.89473684210526 30 L 93.47368421052632 30 L 109.05263157894737 30 L 124.63157894736842 30 L 140.21052631578948 30 L 155.78947368421052 30 L 171.3684210526316 30 L 186.94736842105263 30 L 202.5263157894737 30 L 218.10526315789474 30 L 233.6842105263158 30 L 249.26315789473685 30 L 264.8421052631579 30 L 280.42105263157896 30 L 296 30">
                                        </path>
                                        <path id="SvgjsPath2752"
                                            d="M 0 21.666666666666668 L 15.578947368421053 15.000000000000002 L 31.157894736842106 21.666666666666668 L 46.73684210526316 20 L 62.31578947368421 23.333333333333336 L 77.89473684210526 10.000000000000004 L 93.47368421052632 3.552713678800501e-15 L 109.05263157894737 6.666666666666671 L 124.63157894736842 13.333333333333336 L 140.21052631578948 5.0000000000000036 L 155.78947368421052 10.000000000000004 L 171.3684210526316 21.666666666666668 L 186.94736842105263 16.666666666666668 L 202.5263157894737 21.666666666666668 L 218.10526315789474 10.000000000000004 L 233.6842105263158 21.666666666666668 L 249.26315789473685 10.000000000000004 L 264.8421052631579 13.333333333333336 L 280.42105263157896 3.3333333333333357 L 296 10.000000000000004"
                                            fill="none" fill-opacity="1" stroke="rgba(255, 255, 255, 0.5)"
                                            stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                            stroke-dasharray="0" class="apexcharts-area" index="0"
                                            clip-path="url(#gridRectMaskwpy84lg6)"
                                            pathTo="M 0 21.666666666666668 L 15.578947368421053 15.000000000000002 L 31.157894736842106 21.666666666666668 L 46.73684210526316 20 L 62.31578947368421 23.333333333333336 L 77.89473684210526 10.000000000000004 L 93.47368421052632 3.552713678800501e-15 L 109.05263157894737 6.666666666666671 L 124.63157894736842 13.333333333333336 L 140.21052631578948 5.0000000000000036 L 155.78947368421052 10.000000000000004 L 171.3684210526316 21.666666666666668 L 186.94736842105263 16.666666666666668 L 202.5263157894737 21.666666666666668 L 218.10526315789474 10.000000000000004 L 233.6842105263158 21.666666666666668 L 249.26315789473685 10.000000000000004 L 264.8421052631579 13.333333333333336 L 280.42105263157896 3.3333333333333357 L 296 10.000000000000004"
                                            pathFrom="M -1 30 L -1 30 L 15.578947368421053 30 L 31.157894736842106 30 L 46.73684210526316 30 L 62.31578947368421 30 L 77.89473684210526 30 L 93.47368421052632 30 L 109.05263157894737 30 L 124.63157894736842 30 L 140.21052631578948 30 L 155.78947368421052 30 L 171.3684210526316 30 L 186.94736842105263 30 L 202.5263157894737 30 L 218.10526315789474 30 L 233.6842105263158 30 L 249.26315789473685 30 L 264.8421052631579 30 L 280.42105263157896 30 L 296 30"
                                            fill-rule="evenodd"></path>
                                        <g id="SvgjsG2745"
                                            class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                            data:realIndex="0"></g>
                                    </g>
                                    <g id="SvgjsG2746" class="apexcharts-datalabels" data:realIndex="0"></g>
                                </g>
                                <line id="SvgjsLine2770" x1="0" y1="0" x2="296" y2="0" stroke="#b6b6b6"
                                    stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                    class="apexcharts-ycrosshairs"></line>
                                <line id="SvgjsLine2771" x1="0" y1="0" x2="296" y2="0" stroke-dasharray="0"
                                    stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden">
                                </line>
                                <g id="SvgjsG2772" class="apexcharts-xaxis" transform="translate(0, 0)">
                                    <g id="SvgjsG2773" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
                                    </g>
                                </g>
                                <g id="SvgjsG2795" class="apexcharts-yaxis-annotations"></g>
                                <g id="SvgjsG2796" class="apexcharts-xaxis-annotations"></g>
                                <g id="SvgjsG2797" class="apexcharts-point-annotations"></g>
                            </g>
                        </svg></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="px-3 pt-3  pb-2 pt-0">
                    <div>
                        <h6 class="mb-3 fs-12 text-fixed-white">TODAY ATTANDANCE</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div>
                                <h4 class="fs-20 fw-bold mb-1 text-fixed-white">$120.17</h4>
                                <p class="mb-0 fs-12 text-fixed-white op-7">Compared to last week</p>
                            </div> <span class="float-end my-auto ms-auto"> <i
                                    class="fas fa-arrow-circle-down text-fixed-white"></i> <span
                                    class="text-fixed-white op-7"> -23.09%</span> </span>
                        </div>
                    </div>
                </div>
                <div id="compositeline2" style="min-height: 30px;">
                    <div id="apexchartsp04r1hzy" class="apexcharts-canvas apexchartsp04r1hzy apexcharts-theme-light"
                        style="width: 296px; height: 30px;"><svg id="SvgjsSvg2798" width="296" height="30"
                            xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS"
                            transform="translate(0, 0)" style="background: transparent;">
                            <foreignObject x="0" y="0" width="296" height="30">
                                <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"
                                    style="max-height: 15px;"></div>
                            </foreignObject>
                            <rect id="SvgjsRect2802" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1"
                                stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                            <g id="SvgjsG2857" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                            <g id="SvgjsG2800" class="apexcharts-inner apexcharts-graphical"
                                transform="translate(0, 0)">
                                <defs id="SvgjsDefs2799">
                                    <clipPath id="gridRectMaskp04r1hzy">
                                        <rect id="SvgjsRect2804" width="302" height="32" x="-3" y="-1" rx="0" ry="0"
                                            opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                        </rect>
                                    </clipPath>
                                    <clipPath id="forecastMaskp04r1hzy"></clipPath>
                                    <clipPath id="nonForecastMaskp04r1hzy"></clipPath>
                                    <clipPath id="gridRectMarkerMaskp04r1hzy">
                                        <rect id="SvgjsRect2805" width="300" height="34" x="-2" y="-2" rx="0" ry="0"
                                            opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                        </rect>
                                    </clipPath>
                                    <linearGradient id="SvgjsLinearGradient2810" x1="0" y1="0" x2="0" y2="1">
                                        <stop id="SvgjsStop2811" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)"
                                            offset="0"></stop>
                                        <stop id="SvgjsStop2812" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)"
                                            offset="1"></stop>
                                        <stop id="SvgjsStop2813" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)"
                                            offset="1"></stop>
                                    </linearGradient>
                                </defs>
                                <line id="SvgjsLine2803" x1="0" y1="0" x2="0" y2="30" stroke="#b6b6b6"
                                    stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0"
                                    y="0" width="1" height="30" fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                    stroke-width="1"></line>
                                <g id="SvgjsG2816" class="apexcharts-grid">
                                    <g id="SvgjsG2817" class="apexcharts-gridlines-horizontal" style="display: none;">
                                        <line id="SvgjsLine2820" x1="0" y1="0" x2="296" y2="0" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2821" x1="0" y1="3" x2="296" y2="3" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2822" x1="0" y1="6" x2="296" y2="6" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2823" x1="0" y1="9" x2="296" y2="9" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2824" x1="0" y1="12" x2="296" y2="12" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2825" x1="0" y1="15" x2="296" y2="15" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2826" x1="0" y1="18" x2="296" y2="18" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2827" x1="0" y1="21" x2="296" y2="21" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2828" x1="0" y1="24" x2="296" y2="24" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2829" x1="0" y1="27" x2="296" y2="27" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2830" x1="0" y1="30" x2="296" y2="30" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                    </g>
                                    <g id="SvgjsG2818" class="apexcharts-gridlines-vertical" style="display: none;">
                                    </g>
                                    <line id="SvgjsLine2832" x1="0" y1="30" x2="296" y2="30" stroke="transparent"
                                        stroke-dasharray="0" stroke-linecap="butt"></line>
                                    <line id="SvgjsLine2831" x1="0" y1="1" x2="0" y2="30" stroke="transparent"
                                        stroke-dasharray="0" stroke-linecap="butt"></line>
                                </g>
                                <g id="SvgjsG2819" class="apexcharts-grid-borders" style="display: none;"></g>
                                <g id="SvgjsG2806" class="apexcharts-area-series apexcharts-plot-series">
                                    <g id="SvgjsG2807" class="apexcharts-series" seriesName="Value"
                                        data:longestSeries="true" rel="1" data:realIndex="0">
                                        <path id="SvgjsPath2814"
                                            d="M 0 30 L 0 24.375 L 15.578947368421053 26.25 L 31.157894736842106 22.5 L 46.73684210526316 18.75 L 62.31578947368421 7.5 L 77.89473684210526 3.75 L 93.47368421052632 15 L 109.05263157894737 16.875 L 124.63157894736842 3.75 L 140.21052631578948 0 L 155.78947368421052 7.5 L 171.3684210526316 16.875 L 186.94736842105263 15 L 202.5263157894737 22.5 L 218.10526315789474 24.375 L 233.6842105263158 26.25 L 249.26315789473685 26.25 L 264.8421052631579 20.625 L 280.42105263157896 18.75 L 296 16.875 L 296 30M 296 16.875z"
                                            fill="url(#SvgjsLinearGradient2810)" fill-opacity="1" stroke-opacity="1"
                                            stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                            class="apexcharts-area" index="0" clip-path="url(#gridRectMaskp04r1hzy)"
                                            pathTo="M 0 30 L 0 24.375 L 15.578947368421053 26.25 L 31.157894736842106 22.5 L 46.73684210526316 18.75 L 62.31578947368421 7.5 L 77.89473684210526 3.75 L 93.47368421052632 15 L 109.05263157894737 16.875 L 124.63157894736842 3.75 L 140.21052631578948 0 L 155.78947368421052 7.5 L 171.3684210526316 16.875 L 186.94736842105263 15 L 202.5263157894737 22.5 L 218.10526315789474 24.375 L 233.6842105263158 26.25 L 249.26315789473685 26.25 L 264.8421052631579 20.625 L 280.42105263157896 18.75 L 296 16.875 L 296 30M 296 16.875z"
                                            pathFrom="M -1 30 L -1 30 L 15.578947368421053 30 L 31.157894736842106 30 L 46.73684210526316 30 L 62.31578947368421 30 L 77.89473684210526 30 L 93.47368421052632 30 L 109.05263157894737 30 L 124.63157894736842 30 L 140.21052631578948 30 L 155.78947368421052 30 L 171.3684210526316 30 L 186.94736842105263 30 L 202.5263157894737 30 L 218.10526315789474 30 L 233.6842105263158 30 L 249.26315789473685 30 L 264.8421052631579 30 L 280.42105263157896 30 L 296 30">
                                        </path>
                                        <path id="SvgjsPath2815"
                                            d="M 0 24.375 L 15.578947368421053 26.25 L 31.157894736842106 22.5 L 46.73684210526316 18.75 L 62.31578947368421 7.5 L 77.89473684210526 3.75 L 93.47368421052632 15 L 109.05263157894737 16.875 L 124.63157894736842 3.75 L 140.21052631578948 0 L 155.78947368421052 7.5 L 171.3684210526316 16.875 L 186.94736842105263 15 L 202.5263157894737 22.5 L 218.10526315789474 24.375 L 233.6842105263158 26.25 L 249.26315789473685 26.25 L 264.8421052631579 20.625 L 280.42105263157896 18.75 L 296 16.875"
                                            fill="none" fill-opacity="1" stroke="rgba(255, 255, 255, 0.5)"
                                            stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                            stroke-dasharray="0" class="apexcharts-area" index="0"
                                            clip-path="url(#gridRectMaskp04r1hzy)"
                                            pathTo="M 0 24.375 L 15.578947368421053 26.25 L 31.157894736842106 22.5 L 46.73684210526316 18.75 L 62.31578947368421 7.5 L 77.89473684210526 3.75 L 93.47368421052632 15 L 109.05263157894737 16.875 L 124.63157894736842 3.75 L 140.21052631578948 0 L 155.78947368421052 7.5 L 171.3684210526316 16.875 L 186.94736842105263 15 L 202.5263157894737 22.5 L 218.10526315789474 24.375 L 233.6842105263158 26.25 L 249.26315789473685 26.25 L 264.8421052631579 20.625 L 280.42105263157896 18.75 L 296 16.875"
                                            pathFrom="M -1 30 L -1 30 L 15.578947368421053 30 L 31.157894736842106 30 L 46.73684210526316 30 L 62.31578947368421 30 L 77.89473684210526 30 L 93.47368421052632 30 L 109.05263157894737 30 L 124.63157894736842 30 L 140.21052631578948 30 L 155.78947368421052 30 L 171.3684210526316 30 L 186.94736842105263 30 L 202.5263157894737 30 L 218.10526315789474 30 L 233.6842105263158 30 L 249.26315789473685 30 L 264.8421052631579 30 L 280.42105263157896 30 L 296 30"
                                            fill-rule="evenodd"></path>
                                        <g id="SvgjsG2808"
                                            class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                            data:realIndex="0"></g>
                                    </g>
                                    <g id="SvgjsG2809" class="apexcharts-datalabels" data:realIndex="0"></g>
                                </g>
                                <line id="SvgjsLine2833" x1="0" y1="0" x2="296" y2="0" stroke="#b6b6b6"
                                    stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                    class="apexcharts-ycrosshairs"></line>
                                <line id="SvgjsLine2834" x1="0" y1="0" x2="296" y2="0" stroke-dasharray="0"
                                    stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden">
                                </line>
                                <g id="SvgjsG2835" class="apexcharts-xaxis" transform="translate(0, 0)">
                                    <g id="SvgjsG2836" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
                                    </g>
                                </g>
                                <g id="SvgjsG2858" class="apexcharts-yaxis-annotations"></g>
                                <g id="SvgjsG2859" class="apexcharts-xaxis-annotations"></g>
                                <g id="SvgjsG2860" class="apexcharts-point-annotations"></g>
                            </g>
                        </svg></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="px-3 pt-3  pb-2 pt-0">
                    <div>
                        <h6 class="mb-3 fs-12 text-fixed-white">TOTAL PURCHASE</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div>
                                <h4 class="fs-20 fw-bold mb-1 text-fixed-white">$712.70</h4>
                                <p class="mb-0 fs-12 text-fixed-white op-7">Compared to last week</p>
                            </div> <span class="float-end my-auto ms-auto"> <i
                                    class="fas fa-arrow-circle-up text-fixed-white"></i> <span
                                    class="text-fixed-white op-7"> 2.09%</span> </span>
                        </div>
                    </div>
                </div>
                <div id="compositeline3" style="min-height: 30px;">
                    <div id="apexchartspy5x3ddnk" class="apexcharts-canvas apexchartspy5x3ddnk apexcharts-theme-light"
                        style="width: 296px; height: 30px;"><svg id="SvgjsSvg2861" width="296" height="30"
                            xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS"
                            transform="translate(0, 0)" style="background: transparent;">
                            <foreignObject x="0" y="0" width="296" height="30">
                                <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"
                                    style="max-height: 15px;"></div>
                            </foreignObject>
                            <rect id="SvgjsRect2865" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1"
                                stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                            <g id="SvgjsG2920" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                            <g id="SvgjsG2863" class="apexcharts-inner apexcharts-graphical"
                                transform="translate(0, 0)">
                                <defs id="SvgjsDefs2862">
                                    <clipPath id="gridRectMaskpy5x3ddnk">
                                        <rect id="SvgjsRect2867" width="302" height="32" x="-3" y="-1" rx="0" ry="0"
                                            opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                        </rect>
                                    </clipPath>
                                    <clipPath id="forecastMaskpy5x3ddnk"></clipPath>
                                    <clipPath id="nonForecastMaskpy5x3ddnk"></clipPath>
                                    <clipPath id="gridRectMarkerMaskpy5x3ddnk">
                                        <rect id="SvgjsRect2868" width="300" height="34" x="-2" y="-2" rx="0" ry="0"
                                            opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                        </rect>
                                    </clipPath>
                                    <linearGradient id="SvgjsLinearGradient2873" x1="0" y1="0" x2="0" y2="1">
                                        <stop id="SvgjsStop2874" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)"
                                            offset="0"></stop>
                                        <stop id="SvgjsStop2875" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)"
                                            offset="1"></stop>
                                        <stop id="SvgjsStop2876" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)"
                                            offset="1"></stop>
                                    </linearGradient>
                                </defs>
                                <line id="SvgjsLine2866" x1="0" y1="0" x2="0" y2="30" stroke="#b6b6b6"
                                    stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0"
                                    y="0" width="1" height="30" fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                    stroke-width="1"></line>
                                <g id="SvgjsG2879" class="apexcharts-grid">
                                    <g id="SvgjsG2880" class="apexcharts-gridlines-horizontal" style="display: none;">
                                        <line id="SvgjsLine2883" x1="0" y1="0" x2="296" y2="0" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2884" x1="0" y1="3" x2="296" y2="3" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2885" x1="0" y1="6" x2="296" y2="6" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2886" x1="0" y1="9" x2="296" y2="9" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2887" x1="0" y1="12" x2="296" y2="12" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2888" x1="0" y1="15" x2="296" y2="15" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2889" x1="0" y1="18" x2="296" y2="18" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2890" x1="0" y1="21" x2="296" y2="21" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2891" x1="0" y1="24" x2="296" y2="24" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2892" x1="0" y1="27" x2="296" y2="27" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2893" x1="0" y1="30" x2="296" y2="30" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                    </g>
                                    <g id="SvgjsG2881" class="apexcharts-gridlines-vertical" style="display: none;">
                                    </g>
                                    <line id="SvgjsLine2895" x1="0" y1="30" x2="296" y2="30" stroke="transparent"
                                        stroke-dasharray="0" stroke-linecap="butt"></line>
                                    <line id="SvgjsLine2894" x1="0" y1="1" x2="0" y2="30" stroke="transparent"
                                        stroke-dasharray="0" stroke-linecap="butt"></line>
                                </g>
                                <g id="SvgjsG2882" class="apexcharts-grid-borders" style="display: none;"></g>
                                <g id="SvgjsG2869" class="apexcharts-area-series apexcharts-plot-series">
                                    <g id="SvgjsG2870" class="apexcharts-series" seriesName="Value"
                                        data:longestSeries="true" rel="1" data:realIndex="0">
                                        <path id="SvgjsPath2877"
                                            d="M 0 30 L 0 23.18181818181818 L 15.578947368421053 16.36363636363636 L 31.157894736842106 23.18181818181818 L 46.73684210526316 2.7272727272727195 L 62.31578947368421 -7.105427357601002e-15 L 77.89473684210526 13.636363636363633 L 93.47368421052632 9.54545454545454 L 109.05263157894737 5.45454545454545 L 124.63157894736842 2.7272727272727195 L 140.21052631578948 9.54545454545454 L 155.78947368421052 19.090909090909086 L 171.3684210526316 13.636363636363633 L 186.94736842105263 -7.105427357601002e-15 L 202.5263157894737 23.18181818181818 L 218.10526315789474 16.36363636363636 L 233.6842105263158 13.636363636363633 L 249.26315789473685 -7.105427357601002e-15 L 264.8421052631579 9.54545454545454 L 280.42105263157896 8.181818181818176 L 296 16.36363636363636 L 296 30M 296 16.36363636363636z"
                                            fill="url(#SvgjsLinearGradient2873)" fill-opacity="1" stroke-opacity="1"
                                            stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                            class="apexcharts-area" index="0" clip-path="url(#gridRectMaskpy5x3ddnk)"
                                            pathTo="M 0 30 L 0 23.18181818181818 L 15.578947368421053 16.36363636363636 L 31.157894736842106 23.18181818181818 L 46.73684210526316 2.7272727272727195 L 62.31578947368421 -7.105427357601002e-15 L 77.89473684210526 13.636363636363633 L 93.47368421052632 9.54545454545454 L 109.05263157894737 5.45454545454545 L 124.63157894736842 2.7272727272727195 L 140.21052631578948 9.54545454545454 L 155.78947368421052 19.090909090909086 L 171.3684210526316 13.636363636363633 L 186.94736842105263 -7.105427357601002e-15 L 202.5263157894737 23.18181818181818 L 218.10526315789474 16.36363636363636 L 233.6842105263158 13.636363636363633 L 249.26315789473685 -7.105427357601002e-15 L 264.8421052631579 9.54545454545454 L 280.42105263157896 8.181818181818176 L 296 16.36363636363636 L 296 30M 296 16.36363636363636z"
                                            pathFrom="M -1 30 L -1 30 L 15.578947368421053 30 L 31.157894736842106 30 L 46.73684210526316 30 L 62.31578947368421 30 L 77.89473684210526 30 L 93.47368421052632 30 L 109.05263157894737 30 L 124.63157894736842 30 L 140.21052631578948 30 L 155.78947368421052 30 L 171.3684210526316 30 L 186.94736842105263 30 L 202.5263157894737 30 L 218.10526315789474 30 L 233.6842105263158 30 L 249.26315789473685 30 L 264.8421052631579 30 L 280.42105263157896 30 L 296 30">
                                        </path>
                                        <path id="SvgjsPath2878"
                                            d="M 0 23.18181818181818 L 15.578947368421053 16.36363636363636 L 31.157894736842106 23.18181818181818 L 46.73684210526316 2.7272727272727195 L 62.31578947368421 -7.105427357601002e-15 L 77.89473684210526 13.636363636363633 L 93.47368421052632 9.54545454545454 L 109.05263157894737 5.45454545454545 L 124.63157894736842 2.7272727272727195 L 140.21052631578948 9.54545454545454 L 155.78947368421052 19.090909090909086 L 171.3684210526316 13.636363636363633 L 186.94736842105263 -7.105427357601002e-15 L 202.5263157894737 23.18181818181818 L 218.10526315789474 16.36363636363636 L 233.6842105263158 13.636363636363633 L 249.26315789473685 -7.105427357601002e-15 L 264.8421052631579 9.54545454545454 L 280.42105263157896 8.181818181818176 L 296 16.36363636363636"
                                            fill="none" fill-opacity="1" stroke="rgba(255, 255, 255, 0.5)"
                                            stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                            stroke-dasharray="0" class="apexcharts-area" index="0"
                                            clip-path="url(#gridRectMaskpy5x3ddnk)"
                                            pathTo="M 0 23.18181818181818 L 15.578947368421053 16.36363636363636 L 31.157894736842106 23.18181818181818 L 46.73684210526316 2.7272727272727195 L 62.31578947368421 -7.105427357601002e-15 L 77.89473684210526 13.636363636363633 L 93.47368421052632 9.54545454545454 L 109.05263157894737 5.45454545454545 L 124.63157894736842 2.7272727272727195 L 140.21052631578948 9.54545454545454 L 155.78947368421052 19.090909090909086 L 171.3684210526316 13.636363636363633 L 186.94736842105263 -7.105427357601002e-15 L 202.5263157894737 23.18181818181818 L 218.10526315789474 16.36363636363636 L 233.6842105263158 13.636363636363633 L 249.26315789473685 -7.105427357601002e-15 L 264.8421052631579 9.54545454545454 L 280.42105263157896 8.181818181818176 L 296 16.36363636363636"
                                            pathFrom="M -1 30 L -1 30 L 15.578947368421053 30 L 31.157894736842106 30 L 46.73684210526316 30 L 62.31578947368421 30 L 77.89473684210526 30 L 93.47368421052632 30 L 109.05263157894737 30 L 124.63157894736842 30 L 140.21052631578948 30 L 155.78947368421052 30 L 171.3684210526316 30 L 186.94736842105263 30 L 202.5263157894737 30 L 218.10526315789474 30 L 233.6842105263158 30 L 249.26315789473685 30 L 264.8421052631579 30 L 280.42105263157896 30 L 296 30"
                                            fill-rule="evenodd"></path>
                                        <g id="SvgjsG2871"
                                            class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                            data:realIndex="0"></g>
                                    </g>
                                    <g id="SvgjsG2872" class="apexcharts-datalabels" data:realIndex="0"></g>
                                </g>
                                <line id="SvgjsLine2896" x1="0" y1="0" x2="296" y2="0" stroke="#b6b6b6"
                                    stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                    class="apexcharts-ycrosshairs"></line>
                                <line id="SvgjsLine2897" x1="0" y1="0" x2="296" y2="0" stroke-dasharray="0"
                                    stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden">
                                </line>
                                <g id="SvgjsG2898" class="apexcharts-xaxis" transform="translate(0, 0)">
                                    <g id="SvgjsG2899" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
                                    </g>
                                </g>
                                <g id="SvgjsG2921" class="apexcharts-yaxis-annotations"></g>
                                <g id="SvgjsG2922" class="apexcharts-xaxis-annotations"></g>
                                <g id="SvgjsG2923" class="apexcharts-point-annotations"></g>
                            </g>
                        </svg></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="px-3 pt-3  pb-2 pt-0">
                    <div>
                        <h6 class="mb-3 fs-12 text-fixed-white">PRODUCT USED</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div>
                                <h4 class="fs-20 fw-bold mb-1 text-fixed-white">$420.50</h4>
                                <p class="mb-0 fs-12 text-fixed-white op-7">Compared to last week</p>
                            </div> <span class="float-end my-auto ms-auto"> <i
                                    class="fas fa-arrow-circle-down text-fixed-white"></i> <span
                                    class="text-fixed-white op-7"> -15.3</span> </span>
                        </div>
                    </div>
                </div>
                <div id="compositeline4" style="min-height: 30px;">
                    <div id="apexcharts7yw3ahxh" class="apexcharts-canvas apexcharts7yw3ahxh apexcharts-theme-light"
                        style="width: 296px; height: 30px;"><svg id="SvgjsSvg2924" width="296" height="30"
                            xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS"
                            transform="translate(0, 0)" style="background: transparent;">
                            <foreignObject x="0" y="0" width="296" height="30">
                                <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"
                                    style="max-height: 15px;"></div>
                            </foreignObject>
                            <rect id="SvgjsRect2928" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1"
                                stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                            <g id="SvgjsG2983" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                            <g id="SvgjsG2926" class="apexcharts-inner apexcharts-graphical"
                                transform="translate(0, 0)">
                                <defs id="SvgjsDefs2925">
                                    <clipPath id="gridRectMask7yw3ahxh">
                                        <rect id="SvgjsRect2930" width="302" height="32" x="-3" y="-1" rx="0" ry="0"
                                            opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                        </rect>
                                    </clipPath>
                                    <clipPath id="forecastMask7yw3ahxh"></clipPath>
                                    <clipPath id="nonForecastMask7yw3ahxh"></clipPath>
                                    <clipPath id="gridRectMarkerMask7yw3ahxh">
                                        <rect id="SvgjsRect2931" width="300" height="34" x="-2" y="-2" rx="0" ry="0"
                                            opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                        </rect>
                                    </clipPath>
                                    <linearGradient id="SvgjsLinearGradient2936" x1="0" y1="0" x2="0" y2="1">
                                        <stop id="SvgjsStop2937" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)"
                                            offset="0"></stop>
                                        <stop id="SvgjsStop2938" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)"
                                            offset="1"></stop>
                                        <stop id="SvgjsStop2939" stop-opacity="0.5" stop-color="rgba(255,255,255,0.5)"
                                            offset="1"></stop>
                                    </linearGradient>
                                </defs>
                                <line id="SvgjsLine2929" x1="0" y1="0" x2="0" y2="30" stroke="#b6b6b6"
                                    stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0"
                                    y="0" width="1" height="30" fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                    stroke-width="1"></line>
                                <g id="SvgjsG2942" class="apexcharts-grid">
                                    <g id="SvgjsG2943" class="apexcharts-gridlines-horizontal" style="display: none;">
                                        <line id="SvgjsLine2946" x1="0" y1="0" x2="296" y2="0" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2947" x1="0" y1="3" x2="296" y2="3" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2948" x1="0" y1="6" x2="296" y2="6" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2949" x1="0" y1="9" x2="296" y2="9" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2950" x1="0" y1="12" x2="296" y2="12" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2951" x1="0" y1="15" x2="296" y2="15" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2952" x1="0" y1="18" x2="296" y2="18" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2953" x1="0" y1="21" x2="296" y2="21" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2954" x1="0" y1="24" x2="296" y2="24" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2955" x1="0" y1="27" x2="296" y2="27" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                        <line id="SvgjsLine2956" x1="0" y1="30" x2="296" y2="30" stroke="#e0e0e0"
                                            stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                    </g>
                                    <g id="SvgjsG2944" class="apexcharts-gridlines-vertical" style="display: none;">
                                    </g>
                                    <line id="SvgjsLine2958" x1="0" y1="30" x2="296" y2="30" stroke="transparent"
                                        stroke-dasharray="0" stroke-linecap="butt"></line>
                                    <line id="SvgjsLine2957" x1="0" y1="1" x2="0" y2="30" stroke="transparent"
                                        stroke-dasharray="0" stroke-linecap="butt"></line>
                                </g>
                                <g id="SvgjsG2945" class="apexcharts-grid-borders" style="display: none;"></g>
                                <g id="SvgjsG2932" class="apexcharts-area-series apexcharts-plot-series">
                                    <g id="SvgjsG2933" class="apexcharts-series" seriesName="Value"
                                        data:longestSeries="true" rel="1" data:realIndex="0">
                                        <path id="SvgjsPath2940"
                                            d="M 0 30 L 0 21.666666666666668 L 15.578947368421053 15.000000000000002 L 31.157894736842106 21.666666666666668 L 46.73684210526316 20 L 62.31578947368421 23.333333333333336 L 77.89473684210526 10.000000000000004 L 93.47368421052632 3.552713678800501e-15 L 109.05263157894737 6.666666666666671 L 124.63157894736842 13.333333333333336 L 140.21052631578948 5.0000000000000036 L 155.78947368421052 10.000000000000004 L 171.3684210526316 21.666666666666668 L 186.94736842105263 16.666666666666668 L 202.5263157894737 21.666666666666668 L 218.10526315789474 10.000000000000004 L 233.6842105263158 21.666666666666668 L 249.26315789473685 10.000000000000004 L 264.8421052631579 13.333333333333336 L 280.42105263157896 3.3333333333333357 L 296 10.000000000000004 L 296 30M 296 10.000000000000004z"
                                            fill="url(#SvgjsLinearGradient2936)" fill-opacity="1" stroke-opacity="1"
                                            stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                            class="apexcharts-area" index="0" clip-path="url(#gridRectMask7yw3ahxh)"
                                            pathTo="M 0 30 L 0 21.666666666666668 L 15.578947368421053 15.000000000000002 L 31.157894736842106 21.666666666666668 L 46.73684210526316 20 L 62.31578947368421 23.333333333333336 L 77.89473684210526 10.000000000000004 L 93.47368421052632 3.552713678800501e-15 L 109.05263157894737 6.666666666666671 L 124.63157894736842 13.333333333333336 L 140.21052631578948 5.0000000000000036 L 155.78947368421052 10.000000000000004 L 171.3684210526316 21.666666666666668 L 186.94736842105263 16.666666666666668 L 202.5263157894737 21.666666666666668 L 218.10526315789474 10.000000000000004 L 233.6842105263158 21.666666666666668 L 249.26315789473685 10.000000000000004 L 264.8421052631579 13.333333333333336 L 280.42105263157896 3.3333333333333357 L 296 10.000000000000004 L 296 30M 296 10.000000000000004z"
                                            pathFrom="M -1 30 L -1 30 L 15.578947368421053 30 L 31.157894736842106 30 L 46.73684210526316 30 L 62.31578947368421 30 L 77.89473684210526 30 L 93.47368421052632 30 L 109.05263157894737 30 L 124.63157894736842 30 L 140.21052631578948 30 L 155.78947368421052 30 L 171.3684210526316 30 L 186.94736842105263 30 L 202.5263157894737 30 L 218.10526315789474 30 L 233.6842105263158 30 L 249.26315789473685 30 L 264.8421052631579 30 L 280.42105263157896 30 L 296 30">
                                        </path>
                                        <path id="SvgjsPath2941"
                                            d="M 0 21.666666666666668 L 15.578947368421053 15.000000000000002 L 31.157894736842106 21.666666666666668 L 46.73684210526316 20 L 62.31578947368421 23.333333333333336 L 77.89473684210526 10.000000000000004 L 93.47368421052632 3.552713678800501e-15 L 109.05263157894737 6.666666666666671 L 124.63157894736842 13.333333333333336 L 140.21052631578948 5.0000000000000036 L 155.78947368421052 10.000000000000004 L 171.3684210526316 21.666666666666668 L 186.94736842105263 16.666666666666668 L 202.5263157894737 21.666666666666668 L 218.10526315789474 10.000000000000004 L 233.6842105263158 21.666666666666668 L 249.26315789473685 10.000000000000004 L 264.8421052631579 13.333333333333336 L 280.42105263157896 3.3333333333333357 L 296 10.000000000000004"
                                            fill="none" fill-opacity="1" stroke="rgba(255, 255, 255, 0.5)"
                                            stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                            stroke-dasharray="0" class="apexcharts-area" index="0"
                                            clip-path="url(#gridRectMask7yw3ahxh)"
                                            pathTo="M 0 21.666666666666668 L 15.578947368421053 15.000000000000002 L 31.157894736842106 21.666666666666668 L 46.73684210526316 20 L 62.31578947368421 23.333333333333336 L 77.89473684210526 10.000000000000004 L 93.47368421052632 3.552713678800501e-15 L 109.05263157894737 6.666666666666671 L 124.63157894736842 13.333333333333336 L 140.21052631578948 5.0000000000000036 L 155.78947368421052 10.000000000000004 L 171.3684210526316 21.666666666666668 L 186.94736842105263 16.666666666666668 L 202.5263157894737 21.666666666666668 L 218.10526315789474 10.000000000000004 L 233.6842105263158 21.666666666666668 L 249.26315789473685 10.000000000000004 L 264.8421052631579 13.333333333333336 L 280.42105263157896 3.3333333333333357 L 296 10.000000000000004"
                                            pathFrom="M -1 30 L -1 30 L 15.578947368421053 30 L 31.157894736842106 30 L 46.73684210526316 30 L 62.31578947368421 30 L 77.89473684210526 30 L 93.47368421052632 30 L 109.05263157894737 30 L 124.63157894736842 30 L 140.21052631578948 30 L 155.78947368421052 30 L 171.3684210526316 30 L 186.94736842105263 30 L 202.5263157894737 30 L 218.10526315789474 30 L 233.6842105263158 30 L 249.26315789473685 30 L 264.8421052631579 30 L 280.42105263157896 30 L 296 30"
                                            fill-rule="evenodd"></path>
                                        <g id="SvgjsG2934"
                                            class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                            data:realIndex="0"></g>
                                    </g>
                                    <g id="SvgjsG2935" class="apexcharts-datalabels" data:realIndex="0"></g>
                                </g>
                                <line id="SvgjsLine2959" x1="0" y1="0" x2="296" y2="0" stroke="#b6b6b6"
                                    stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                    class="apexcharts-ycrosshairs"></line>
                                <line id="SvgjsLine2960" x1="0" y1="0" x2="296" y2="0" stroke-dasharray="0"
                                    stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden">
                                </line>
                                <g id="SvgjsG2961" class="apexcharts-xaxis" transform="translate(0, 0)">
                                    <g id="SvgjsG2962" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
                                    </g>
                                </g>
                                <g id="SvgjsG2984" class="apexcharts-yaxis-annotations"></g>
                                <g id="SvgjsG2985" class="apexcharts-xaxis-annotations"></g>
                                <g id="SvgjsG2986" class="apexcharts-point-annotations"></g>
                            </g>
                        </svg></div>
                </div>
            </div>
        </div>
    </div> <!-- row closed -->
    <!-- row opened -->
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Order status</h4> <a href="javascript:void(0);"
                            class="btn btn-icon btn-sm btn-light bg-transparent rounded-pill"
                            data-bs-toggle="dropdown"><i class="fe fe-more-horizontal"></i></a>
                        <div class="dropdown-menu"> <a class="dropdown-item" href="javascript:void(0);">Action</a>
                            <a class="dropdown-item" href="javascript:void(0);">Another Action</a> <a
                                class="dropdown-item" href="javascript:void(0);">Something Else Here</a>
                        </div>
                    </div>
                    <p class="fs-12 text-muted mb-0">Order Status and Tracking. Track your order from ship date to
                        arrival. To begin, enter your order number.</p>
                </div>
                <div class="card-body">
                    <div class="total-revenue">
                        <div>
                            <h4>120,750</h4> <label><span class="bg-primary"></span>success</label>
                        </div>
                        <div>
                            <h4>56,108</h4> <label><span class="bg-danger"></span>Pending</label>
                        </div>
                        <div>
                            <h4>32,895</h4> <label><span class="bg-warning"></span>Failed</label>
                        </div>
                    </div>
                    <div id="Sales-bar" class="sales-bar mt-4" style="min-height: 271px;">
                        <div id="apexcharts7j11wuy4" class="apexcharts-canvas apexcharts7j11wuy4 apexcharts-theme-light"
                            style="width: 685px; height: 256px;"><svg id="SvgjsSvg2567" width="685" height="256"
                                xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                style="background: transparent;">
                                <foreignObject x="0" y="0" width="685" height="256">
                                    <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"
                                        style="max-height: 128px;"></div>
                                </foreignObject>
                                <g id="SvgjsG2715" class="apexcharts-yaxis" rel="0"
                                    transform="translate(15.635351181030273, 0)">
                                    <g id="SvgjsG2716" class="apexcharts-yaxis-texts-g"><text id="SvgjsText2718"
                                            font-family="Nunito, sans-serif" x="20" y="31.4" text-anchor="end"
                                            dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: Nunito, sans-serif;">
                                            <tspan id="SvgjsTspan2719">120</tspan>
                                            <title>120</title>
                                        </text><text id="SvgjsText2721" font-family="Nunito, sans-serif" x="20"
                                            y="78.64879984569549" text-anchor="end" dominant-baseline="auto"
                                            font-size="11px" font-weight="400" fill="#373d3f"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: Nunito, sans-serif;">
                                            <tspan id="SvgjsTspan2722">90</tspan>
                                            <title>90</title>
                                        </text><text id="SvgjsText2724" font-family="Nunito, sans-serif" x="20"
                                            y="125.89759969139098" text-anchor="end" dominant-baseline="auto"
                                            font-size="11px" font-weight="400" fill="#373d3f"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: Nunito, sans-serif;">
                                            <tspan id="SvgjsTspan2725">60</tspan>
                                            <title>60</title>
                                        </text><text id="SvgjsText2727" font-family="Nunito, sans-serif" x="20"
                                            y="173.14639953708647" text-anchor="end" dominant-baseline="auto"
                                            font-size="11px" font-weight="400" fill="#373d3f"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: Nunito, sans-serif;">
                                            <tspan id="SvgjsTspan2728">30</tspan>
                                            <title>30</title>
                                        </text><text id="SvgjsText2730" font-family="Nunito, sans-serif" x="20"
                                            y="220.39519938278195" text-anchor="end" dominant-baseline="auto"
                                            font-size="11px" font-weight="400" fill="#373d3f"
                                            class="apexcharts-text apexcharts-yaxis-label "
                                            style="font-family: Nunito, sans-serif;">
                                            <tspan id="SvgjsTspan2731">0</tspan>
                                            <title>0</title>
                                        </text></g>
                                </g>
                                <g id="SvgjsG2569" class="apexcharts-inner apexcharts-graphical"
                                    transform="translate(45.63535118103027, 30)">
                                    <defs id="SvgjsDefs2568">
                                        <linearGradient id="SvgjsLinearGradient2572" x1="0" y1="0" x2="0" y2="1">
                                            <stop id="SvgjsStop2573" stop-opacity="0.4"
                                                stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                            <stop id="SvgjsStop2574" stop-opacity="0.5"
                                                stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                            <stop id="SvgjsStop2575" stop-opacity="0.5"
                                                stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                        </linearGradient>
                                        <clipPath id="gridRectMask7j11wuy4">
                                            <rect id="SvgjsRect2577" width="635.3646488189697"
                                                height="190.99519938278198" x="-3" y="-1" rx="0" ry="0" opacity="1"
                                                stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                            </rect>
                                        </clipPath>
                                        <clipPath id="forecastMask7j11wuy4"></clipPath>
                                        <clipPath id="nonForecastMask7j11wuy4"></clipPath>
                                        <clipPath id="gridRectMarkerMask7j11wuy4">
                                            <rect id="SvgjsRect2578" width="633.3646488189697"
                                                height="192.99519938278198" x="-2" y="-2" rx="0" ry="0" opacity="1"
                                                stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff">
                                            </rect>
                                        </clipPath>
                                    </defs>
                                    <rect id="SvgjsRect2576" width="7.867058110237122" height="188.99519938278198" x="0"
                                        y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3"
                                        fill="url(#SvgjsLinearGradient2572)" class="apexcharts-xcrosshairs"
                                        y2="188.99519938278198" filter="none" fill-opacity="0.9"></rect>
                                    <g id="SvgjsG2664" class="apexcharts-grid">
                                        <g id="SvgjsG2665" class="apexcharts-gridlines-horizontal">
                                            <line id="SvgjsLine2669" x1="0" y1="47.248799845695494"
                                                x2="629.3646488189697" y2="47.248799845695494" stroke="#f3f3f3"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2670" x1="0" y1="94.49759969139099"
                                                x2="629.3646488189697" y2="94.49759969139099" stroke="#f3f3f3"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                            <line id="SvgjsLine2671" x1="0" y1="141.7463995370865"
                                                x2="629.3646488189697" y2="141.7463995370865" stroke="#f3f3f3"
                                                stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline">
                                            </line>
                                        </g>
                                        <g id="SvgjsG2666" class="apexcharts-gridlines-vertical"></g>
                                        <line id="SvgjsLine2674" x1="0" y1="188.99519938278198" x2="629.3646488189697"
                                            y2="188.99519938278198" stroke="transparent" stroke-dasharray="0"
                                            stroke-linecap="butt"></line>
                                        <line id="SvgjsLine2673" x1="0" y1="1" x2="0" y2="188.99519938278198"
                                            stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                                    </g>
                                    <g id="SvgjsG2667" class="apexcharts-grid-borders">
                                        <line id="SvgjsLine2668" x1="0" y1="0" x2="629.3646488189697" y2="0"
                                            stroke="#f3f3f3" stroke-dasharray="0" stroke-linecap="butt"
                                            class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine2672" x1="0" y1="188.99519938278198" x2="629.3646488189697"
                                            y2="188.99519938278198" stroke="#f3f3f3" stroke-dasharray="0"
                                            stroke-linecap="butt" class="apexcharts-gridline">
                                        </line>
                                    </g>
                                    <g id="SvgjsG2579" class="apexcharts-bar-series apexcharts-plot-series">
                                        <g id="SvgjsG2580" class="apexcharts-series" rel="1" seriesName="Impressions"
                                            data:realIndex="0">
                                            <path id="SvgjsPath2585"
                                                d="M 14.422939868768054 188.99619938278198 L 14.422939868768054 72.44915976339975 L 20.289997979005175 72.44915976339975 L 20.289997979005175 188.99619938278198 Z"
                                                fill="#0162e8" fill-opacity="1" stroke="transparent" stroke-opacity="1"
                                                stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-bar-area" index="0"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 14.422939868768054 188.99619938278198 L 14.422939868768054 72.44915976339975 L 20.289997979005175 72.44915976339975 L 20.289997979005175 188.99619938278198 Z"
                                                pathFrom="M 14.285439868768055 188.99619938278198 L 14.285439868768055 72.44915976339975 L 20.077497979005177 72.44915976339975 L 20.077497979005177 188.99619938278198 Z L 14.422939868768054 188.99619938278198 L 20.289997979005175 188.99619938278198 L 20.289997979005175 188.99619938278198 L 20.289997979005175 188.99619938278198 L 20.289997979005175 188.99619938278198 L 20.289997979005175 188.99619938278198 L 14.422939868768054 188.99619938278198 Z"
                                                cy="72.44815976339974" cx="65.86999393701552" j="0" val="74"
                                                barHeight="116.54703961938223" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2587"
                                                d="M 66.86999393701552 188.99619938278198 L 66.86999393701552 55.124599819978066 L 72.73705204725265 55.124599819978066 L 72.73705204725265 188.99619938278198 Z"
                                                fill="#0162e8" fill-opacity="1" stroke="transparent" stroke-opacity="1"
                                                stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-bar-area" index="0"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 66.86999393701552 188.99619938278198 L 66.86999393701552 55.124599819978066 L 72.73705204725265 55.124599819978066 L 72.73705204725265 188.99619938278198 Z"
                                                pathFrom="M 66.23249393701553 188.99619938278198 L 66.23249393701553 55.124599819978066 L 72.02455204725266 55.124599819978066 L 72.02455204725266 188.99619938278198 Z L 66.86999393701552 188.99619938278198 L 72.73705204725265 188.99619938278198 L 72.73705204725265 188.99619938278198 L 72.73705204725265 188.99619938278198 L 72.73705204725265 188.99619938278198 L 72.73705204725265 188.99619938278198 L 66.86999393701552 188.99619938278198 Z"
                                                cy="55.12359981997807" cx="118.31704800526299" j="1" val="85"
                                                barHeight="133.8715995628039" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2589"
                                                d="M 119.31704800526299 188.99619938278198 L 119.31704800526299 99.22347967596053 L 125.18410611550011 99.22347967596053 L 125.18410611550011 188.99619938278198 Z"
                                                fill="#0162e8" fill-opacity="1" stroke="transparent" stroke-opacity="1"
                                                stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-bar-area" index="0"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 119.31704800526299 188.99619938278198 L 119.31704800526299 99.22347967596053 L 125.18410611550011 99.22347967596053 L 125.18410611550011 188.99619938278198 Z"
                                                pathFrom="M 118.179548005263 188.99619938278198 L 118.179548005263 99.22347967596053 L 123.97160611550012 99.22347967596053 L 123.97160611550012 188.99619938278198 Z L 119.31704800526299 188.99619938278198 L 125.18410611550011 188.99619938278198 L 125.18410611550011 188.99619938278198 L 125.18410611550011 188.99619938278198 L 125.18410611550011 188.99619938278198 L 125.18410611550011 188.99619938278198 L 119.31704800526299 188.99619938278198 Z"
                                                cy="99.22247967596053" cx="170.76410207351046" j="2" val="57"
                                                barHeight="89.77271970682145" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2591"
                                                d="M 171.76410207351046 188.99619938278198 L 171.76410207351046 100.79843967081705 L 177.63116018374757 100.79843967081705 L 177.63116018374757 188.99619938278198 Z"
                                                fill="#0162e8" fill-opacity="1" stroke="transparent" stroke-opacity="1"
                                                stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-bar-area" index="0"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 171.76410207351046 188.99619938278198 L 171.76410207351046 100.79843967081705 L 177.63116018374757 100.79843967081705 L 177.63116018374757 188.99619938278198 Z"
                                                pathFrom="M 170.12660207351047 188.99619938278198 L 170.12660207351047 100.79843967081705 L 175.9186601837476 100.79843967081705 L 175.9186601837476 188.99619938278198 Z L 171.76410207351046 188.99619938278198 L 177.63116018374757 188.99619938278198 L 177.63116018374757 188.99619938278198 L 177.63116018374757 188.99619938278198 L 177.63116018374757 188.99619938278198 L 177.63116018374757 188.99619938278198 L 171.76410207351046 188.99619938278198 Z"
                                                cy="100.79743967081704" cx="223.21115614175793" j="3" val="56"
                                                barHeight="88.19775971196493" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2593"
                                                d="M 224.21115614175793 188.99619938278198 L 224.21115614175793 69.29923977368672 L 230.07821425199504 69.29923977368672 L 230.07821425199504 188.99619938278198 Z"
                                                fill="#0162e8" fill-opacity="1" stroke="transparent" stroke-opacity="1"
                                                stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-bar-area" index="0"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 224.21115614175793 188.99619938278198 L 224.21115614175793 69.29923977368672 L 230.07821425199504 69.29923977368672 L 230.07821425199504 188.99619938278198 Z"
                                                pathFrom="M 222.07365614175794 188.99619938278198 L 222.07365614175794 69.29923977368672 L 227.86571425199506 69.29923977368672 L 227.86571425199506 188.99619938278198 Z L 224.21115614175793 188.99619938278198 L 230.07821425199504 188.99619938278198 L 230.07821425199504 188.99619938278198 L 230.07821425199504 188.99619938278198 L 230.07821425199504 188.99619938278198 L 230.07821425199504 188.99619938278198 L 224.21115614175793 188.99619938278198 Z"
                                                cy="69.29823977368672" cx="275.6582102100054" j="4" val="76"
                                                barHeight="119.69695960909526" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2595"
                                                d="M 276.6582102100054 188.99619938278198 L 276.6582102100054 133.8725995628039 L 282.5252683202425 133.8725995628039 L 282.5252683202425 188.99619938278198 Z"
                                                fill="#0162e8" fill-opacity="1" stroke="transparent" stroke-opacity="1"
                                                stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-bar-area" index="0"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 276.6582102100054 188.99619938278198 L 276.6582102100054 133.8725995628039 L 282.5252683202425 133.8725995628039 L 282.5252683202425 188.99619938278198 Z"
                                                pathFrom="M 274.0207102100054 188.99619938278198 L 274.0207102100054 133.8725995628039 L 279.8127683202425 133.8725995628039 L 279.8127683202425 188.99619938278198 Z L 276.6582102100054 188.99619938278198 L 282.5252683202425 188.99619938278198 L 282.5252683202425 188.99619938278198 L 282.5252683202425 188.99619938278198 L 282.5252683202425 188.99619938278198 L 282.5252683202425 188.99619938278198 L 276.6582102100054 188.99619938278198 Z"
                                                cy="133.8715995628039" cx="328.1052642782529" j="5" val="35"
                                                barHeight="55.12359981997808" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2597"
                                                d="M 329.1052642782529 188.99619938278198 L 329.1052642782529 92.92363969653447 L 334.97232238849 92.92363969653447 L 334.97232238849 188.99619938278198 Z"
                                                fill="#0162e8" fill-opacity="1" stroke="transparent" stroke-opacity="1"
                                                stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-bar-area" index="0"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 329.1052642782529 188.99619938278198 L 329.1052642782529 92.92363969653447 L 334.97232238849 92.92363969653447 L 334.97232238849 188.99619938278198 Z"
                                                pathFrom="M 325.9677642782529 188.99619938278198 L 325.9677642782529 92.92363969653447 L 331.75982238849 92.92363969653447 L 331.75982238849 188.99619938278198 Z L 329.1052642782529 188.99619938278198 L 334.97232238849 188.99619938278198 L 334.97232238849 188.99619938278198 L 334.97232238849 188.99619938278198 L 334.97232238849 188.99619938278198 L 334.97232238849 188.99619938278198 L 329.1052642782529 188.99619938278198 Z"
                                                cy="92.92263969653446" cx="380.5523183465004" j="6" val="61"
                                                barHeight="96.07255968624752" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2599"
                                                d="M 381.5523183465004 188.99619938278198 L 381.5523183465004 34.65011988684335 L 387.4193764567375 34.65011988684335 L 387.4193764567375 188.99619938278198 Z"
                                                fill="#0162e8" fill-opacity="1" stroke="transparent" stroke-opacity="1"
                                                stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-bar-area" index="0"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 381.5523183465004 188.99619938278198 L 381.5523183465004 34.65011988684335 L 387.4193764567375 34.65011988684335 L 387.4193764567375 188.99619938278198 Z"
                                                pathFrom="M 377.9148183465004 188.99619938278198 L 377.9148183465004 34.65011988684335 L 383.7068764567375 34.65011988684335 L 383.7068764567375 188.99619938278198 Z L 381.5523183465004 188.99619938278198 L 387.4193764567375 188.99619938278198 L 387.4193764567375 188.99619938278198 L 387.4193764567375 188.99619938278198 L 387.4193764567375 188.99619938278198 L 387.4193764567375 188.99619938278198 L 381.5523183465004 188.99619938278198 Z"
                                                cy="34.64911988684335" cx="432.9993724147479" j="7" val="98"
                                                barHeight="154.34607949593862" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2601"
                                                d="M 433.9993724147479 188.99619938278198 L 433.9993724147479 132.29763956794739 L 439.866430524985 132.29763956794739 L 439.866430524985 188.99619938278198 Z"
                                                fill="#0162e8" fill-opacity="1" stroke="transparent" stroke-opacity="1"
                                                stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-bar-area" index="0"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 433.9993724147479 188.99619938278198 L 433.9993724147479 132.29763956794739 L 439.866430524985 132.29763956794739 L 439.866430524985 188.99619938278198 Z"
                                                pathFrom="M 429.8618724147479 188.99619938278198 L 429.8618724147479 132.29763956794739 L 435.653930524985 132.29763956794739 L 435.653930524985 188.99619938278198 Z L 433.9993724147479 188.99619938278198 L 439.866430524985 188.99619938278198 L 439.866430524985 188.99619938278198 L 439.866430524985 188.99619938278198 L 439.866430524985 188.99619938278198 L 439.866430524985 188.99619938278198 L 433.9993724147479 188.99619938278198 Z"
                                                cy="132.29663956794738" cx="485.4464264829954" j="8" val="36"
                                                barHeight="56.698559814834596" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2603"
                                                d="M 486.4464264829954 188.99619938278198 L 486.4464264829954 110.24819963995616 L 492.3134845932325 110.24819963995616 L 492.3134845932325 188.99619938278198 Z"
                                                fill="#0162e8" fill-opacity="1" stroke="transparent" stroke-opacity="1"
                                                stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-bar-area" index="0"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 486.4464264829954 188.99619938278198 L 486.4464264829954 110.24819963995616 L 492.3134845932325 110.24819963995616 L 492.3134845932325 188.99619938278198 Z"
                                                pathFrom="M 481.8089264829954 188.99619938278198 L 481.8089264829954 110.24819963995616 L 487.6009845932325 110.24819963995616 L 487.6009845932325 188.99619938278198 Z L 486.4464264829954 188.99619938278198 L 492.3134845932325 188.99619938278198 L 492.3134845932325 188.99619938278198 L 492.3134845932325 188.99619938278198 L 492.3134845932325 188.99619938278198 L 492.3134845932325 188.99619938278198 L 486.4464264829954 188.99619938278198 Z"
                                                cy="110.24719963995615" cx="537.8934805512429" j="9" val="50"
                                                barHeight="78.74799974282583" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2605"
                                                d="M 538.8934805512429 188.99619938278198 L 538.8934805512429 113.39811962966918 L 544.76053866148 113.39811962966918 L 544.76053866148 188.99619938278198 Z"
                                                fill="#0162e8" fill-opacity="1" stroke="transparent" stroke-opacity="1"
                                                stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-bar-area" index="0"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 538.8934805512429 188.99619938278198 L 538.8934805512429 113.39811962966918 L 544.76053866148 113.39811962966918 L 544.76053866148 188.99619938278198 Z"
                                                pathFrom="M 533.7559805512428 188.99619938278198 L 533.7559805512428 113.39811962966918 L 539.54803866148 113.39811962966918 L 539.54803866148 188.99619938278198 Z L 538.8934805512429 188.99619938278198 L 544.76053866148 188.99619938278198 L 544.76053866148 188.99619938278198 L 544.76053866148 188.99619938278198 L 544.76053866148 188.99619938278198 L 544.76053866148 188.99619938278198 L 538.8934805512429 188.99619938278198 Z"
                                                cy="113.39711962966918" cx="590.3405346194903" j="10" val="48"
                                                barHeight="75.5980797531128" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2607"
                                                d="M 591.3405346194903 188.99619938278198 L 591.3405346194903 143.322359531943 L 597.2075927297275 143.322359531943 L 597.2075927297275 188.99619938278198 Z"
                                                fill="#0162e8" fill-opacity="1" stroke="transparent" stroke-opacity="1"
                                                stroke-linecap="round" stroke-width="2" stroke-dasharray="0"
                                                class="apexcharts-bar-area" index="0"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 591.3405346194903 188.99619938278198 L 591.3405346194903 143.322359531943 L 597.2075927297275 143.322359531943 L 597.2075927297275 188.99619938278198 Z"
                                                pathFrom="M 585.7030346194903 188.99619938278198 L 585.7030346194903 143.322359531943 L 591.4950927297274 143.322359531943 L 591.4950927297274 188.99619938278198 Z L 591.3405346194903 188.99619938278198 L 597.2075927297275 188.99619938278198 L 597.2075927297275 188.99619938278198 L 597.2075927297275 188.99619938278198 L 597.2075927297275 188.99619938278198 L 597.2075927297275 188.99619938278198 L 591.3405346194903 188.99619938278198 Z"
                                                cy="143.321359531943" cx="642.7875886877378" j="11" val="29"
                                                barHeight="45.67383985083898" barWidth="7.867058110237122"></path>
                                            <g id="SvgjsG2582" class="apexcharts-bar-goals-markers">
                                                <g id="SvgjsG2584" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2586" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2588" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2590" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2592" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2594" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2596" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2598" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2600" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2602" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2604" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2606" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                            </g>
                                            <g id="SvgjsG2583"
                                                class="apexcharts-bar-shadows apexcharts-hidden-element-shown"></g>
                                        </g>
                                        <g id="SvgjsG2608" class="apexcharts-series" rel="2" seriesName="Turnover"
                                            data:realIndex="1">
                                            <path id="SvgjsPath2613"
                                                d="M 22.289997979005175 188.99619938278198 L 22.289997979005175 116.54803961938222 L 28.157056089242296 116.54803961938222 L 28.157056089242296 188.99619938278198 Z"
                                                fill="rgba(249,58,90,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 22.289997979005175 188.99619938278198 L 22.289997979005175 116.54803961938222 L 28.157056089242296 116.54803961938222 L 28.157056089242296 188.99619938278198 Z"
                                                pathFrom="M 22.077497979005177 188.99619938278198 L 22.077497979005177 116.54803961938222 L 27.869556089242298 116.54803961938222 L 27.869556089242298 188.99619938278198 Z L 22.289997979005175 188.99619938278198 L 28.157056089242296 188.99619938278198 L 28.157056089242296 188.99619938278198 L 28.157056089242296 188.99619938278198 L 28.157056089242296 188.99619938278198 L 28.157056089242296 188.99619938278198 L 22.289997979005175 188.99619938278198 Z"
                                                cy="116.54703961938222" cx="73.73705204725265" j="0" val="46"
                                                barHeight="72.44815976339976" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2615"
                                                d="M 74.73705204725265 188.99619938278198 L 74.73705204725265 133.8725995628039 L 80.60411015748977 133.8725995628039 L 80.60411015748977 188.99619938278198 Z"
                                                fill="rgba(249,58,90,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 74.73705204725265 188.99619938278198 L 74.73705204725265 133.8725995628039 L 80.60411015748977 133.8725995628039 L 80.60411015748977 188.99619938278198 Z"
                                                pathFrom="M 74.02455204725266 188.99619938278198 L 74.02455204725266 133.8725995628039 L 79.81661015748978 133.8725995628039 L 79.81661015748978 188.99619938278198 Z L 74.73705204725265 188.99619938278198 L 80.60411015748977 188.99619938278198 L 80.60411015748977 188.99619938278198 L 80.60411015748977 188.99619938278198 L 80.60411015748977 188.99619938278198 L 80.60411015748977 188.99619938278198 L 74.73705204725265 188.99619938278198 Z"
                                                cy="133.8715995628039" cx="126.18410611550011" j="1" val="35"
                                                barHeight="55.12359981997808" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2617"
                                                d="M 127.18410611550011 188.99619938278198 L 127.18410611550011 29.9252399022738 L 133.05116422573724 29.9252399022738 L 133.05116422573724 188.99619938278198 Z"
                                                fill="rgba(249,58,90,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 127.18410611550011 188.99619938278198 L 127.18410611550011 29.9252399022738 L 133.05116422573724 29.9252399022738 L 133.05116422573724 188.99619938278198 Z"
                                                pathFrom="M 125.97160611550012 188.99619938278198 L 125.97160611550012 29.9252399022738 L 131.76366422573724 29.9252399022738 L 131.76366422573724 188.99619938278198 Z L 127.18410611550011 188.99619938278198 L 133.05116422573724 188.99619938278198 L 133.05116422573724 188.99619938278198 L 133.05116422573724 188.99619938278198 L 133.05116422573724 188.99619938278198 L 133.05116422573724 188.99619938278198 L 127.18410611550011 188.99619938278198 Z"
                                                cy="29.924239902273797" cx="178.63116018374757" j="2" val="101"
                                                barHeight="159.07095948050818" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2619"
                                                d="M 179.63116018374757 188.99619938278198 L 179.63116018374757 34.65011988684335 L 185.49821829398468 34.65011988684335 L 185.49821829398468 188.99619938278198 Z"
                                                fill="rgba(249,58,90,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 179.63116018374757 188.99619938278198 L 179.63116018374757 34.65011988684335 L 185.49821829398468 34.65011988684335 L 185.49821829398468 188.99619938278198 Z"
                                                pathFrom="M 177.9186601837476 188.99619938278198 L 177.9186601837476 34.65011988684335 L 183.7107182939847 34.65011988684335 L 183.7107182939847 188.99619938278198 Z L 179.63116018374757 188.99619938278198 L 185.49821829398468 188.99619938278198 L 185.49821829398468 188.99619938278198 L 185.49821829398468 188.99619938278198 L 185.49821829398468 188.99619938278198 L 185.49821829398468 188.99619938278198 L 179.63116018374757 188.99619938278198 Z"
                                                cy="34.64911988684335" cx="231.07821425199504" j="3" val="98"
                                                barHeight="154.34607949593862" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2621"
                                                d="M 232.07821425199504 188.99619938278198 L 232.07821425199504 119.69795960909525 L 237.94527236223215 119.69795960909525 L 237.94527236223215 188.99619938278198 Z"
                                                fill="rgba(249,58,90,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 232.07821425199504 188.99619938278198 L 232.07821425199504 119.69795960909525 L 237.94527236223215 119.69795960909525 L 237.94527236223215 188.99619938278198 Z"
                                                pathFrom="M 229.86571425199506 188.99619938278198 L 229.86571425199506 119.69795960909525 L 235.65777236223218 119.69795960909525 L 235.65777236223218 188.99619938278198 Z L 232.07821425199504 188.99619938278198 L 237.94527236223215 188.99619938278198 L 237.94527236223215 188.99619938278198 L 237.94527236223215 188.99619938278198 L 237.94527236223215 188.99619938278198 L 237.94527236223215 188.99619938278198 L 232.07821425199504 188.99619938278198 Z"
                                                cy="119.69695960909525" cx="283.5252683202425" j="4" val="44"
                                                barHeight="69.29823977368673" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2623"
                                                d="M 284.5252683202425 188.99619938278198 L 284.5252683202425 102.37339966567357 L 290.3923264304796 102.37339966567357 L 290.3923264304796 188.99619938278198 Z"
                                                fill="rgba(249,58,90,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 284.5252683202425 188.99619938278198 L 284.5252683202425 102.37339966567357 L 290.3923264304796 102.37339966567357 L 290.3923264304796 188.99619938278198 Z"
                                                pathFrom="M 281.8127683202425 188.99619938278198 L 281.8127683202425 102.37339966567357 L 287.60482643047965 102.37339966567357 L 287.60482643047965 188.99619938278198 Z L 284.5252683202425 188.99619938278198 L 290.3923264304796 188.99619938278198 L 290.3923264304796 188.99619938278198 L 290.3923264304796 188.99619938278198 L 290.3923264304796 188.99619938278198 L 290.3923264304796 188.99619938278198 L 284.5252683202425 188.99619938278198 Z"
                                                cy="102.37239966567357" cx="335.97232238849" j="5" val="55"
                                                barHeight="86.6227997171084" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2625"
                                                d="M 336.97232238849 188.99619938278198 L 336.97232238849 99.22347967596053 L 342.8393804987271 99.22347967596053 L 342.8393804987271 188.99619938278198 Z"
                                                fill="rgba(249,58,90,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 336.97232238849 188.99619938278198 L 336.97232238849 99.22347967596053 L 342.8393804987271 99.22347967596053 L 342.8393804987271 188.99619938278198 Z"
                                                pathFrom="M 333.75982238849 188.99619938278198 L 333.75982238849 99.22347967596053 L 339.55188049872714 99.22347967596053 L 339.55188049872714 188.99619938278198 Z L 336.97232238849 188.99619938278198 L 342.8393804987271 188.99619938278198 L 342.8393804987271 188.99619938278198 L 342.8393804987271 188.99619938278198 L 342.8393804987271 188.99619938278198 L 342.8393804987271 188.99619938278198 L 336.97232238849 188.99619938278198 Z"
                                                cy="99.22247967596053" cx="388.4193764567375" j="6" val="57"
                                                barHeight="89.77271970682145" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2627"
                                                d="M 389.4193764567375 188.99619938278198 L 389.4193764567375 100.79843967081705 L 395.2864345669746 100.79843967081705 L 395.2864345669746 188.99619938278198 Z"
                                                fill="rgba(249,58,90,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 389.4193764567375 188.99619938278198 L 389.4193764567375 100.79843967081705 L 395.2864345669746 100.79843967081705 L 395.2864345669746 188.99619938278198 Z"
                                                pathFrom="M 385.7068764567375 188.99619938278198 L 385.7068764567375 100.79843967081705 L 391.49893456697464 100.79843967081705 L 391.49893456697464 188.99619938278198 Z L 389.4193764567375 188.99619938278198 L 395.2864345669746 188.99619938278198 L 395.2864345669746 188.99619938278198 L 395.2864345669746 188.99619938278198 L 395.2864345669746 188.99619938278198 L 395.2864345669746 188.99619938278198 L 389.4193764567375 188.99619938278198 Z"
                                                cy="100.79743967081704" cx="440.866430524985" j="7" val="56"
                                                barHeight="88.19775971196493" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2629"
                                                d="M 441.866430524985 188.99619938278198 L 441.866430524985 102.37339966567357 L 447.7334886352221 102.37339966567357 L 447.7334886352221 188.99619938278198 Z"
                                                fill="rgba(249,58,90,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 441.866430524985 188.99619938278198 L 441.866430524985 102.37339966567357 L 447.7334886352221 102.37339966567357 L 447.7334886352221 188.99619938278198 Z"
                                                pathFrom="M 437.653930524985 188.99619938278198 L 437.653930524985 102.37339966567357 L 443.44598863522214 102.37339966567357 L 443.44598863522214 188.99619938278198 Z L 441.866430524985 188.99619938278198 L 447.7334886352221 188.99619938278198 L 447.7334886352221 188.99619938278198 L 447.7334886352221 188.99619938278198 L 447.7334886352221 188.99619938278198 L 447.7334886352221 188.99619938278198 L 441.866430524985 188.99619938278198 Z"
                                                cy="102.37239966567357" cx="493.3134845932325" j="8" val="55"
                                                barHeight="86.6227997171084" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2631"
                                                d="M 494.3134845932325 188.99619938278198 L 494.3134845932325 135.4475595576604 L 500.1805427034696 135.4475595576604 L 500.1805427034696 188.99619938278198 Z"
                                                fill="rgba(249,58,90,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 494.3134845932325 188.99619938278198 L 494.3134845932325 135.4475595576604 L 500.1805427034696 135.4475595576604 L 500.1805427034696 188.99619938278198 Z"
                                                pathFrom="M 489.6009845932325 188.99619938278198 L 489.6009845932325 135.4475595576604 L 495.39304270346963 135.4475595576604 L 495.39304270346963 188.99619938278198 Z L 494.3134845932325 188.99619938278198 L 500.1805427034696 188.99619938278198 L 500.1805427034696 188.99619938278198 L 500.1805427034696 188.99619938278198 L 500.1805427034696 188.99619938278198 L 500.1805427034696 188.99619938278198 L 494.3134845932325 188.99619938278198 Z"
                                                cy="135.4465595576604" cx="545.76053866148" j="9" val="34"
                                                barHeight="53.54863982512156" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2633"
                                                d="M 546.76053866148 188.99619938278198 L 546.76053866148 64.57435978911717 L 552.6275967717172 64.57435978911717 L 552.6275967717172 188.99619938278198 Z"
                                                fill="rgba(249,58,90,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 546.76053866148 188.99619938278198 L 546.76053866148 64.57435978911717 L 552.6275967717172 64.57435978911717 L 552.6275967717172 188.99619938278198 Z"
                                                pathFrom="M 541.54803866148 188.99619938278198 L 541.54803866148 64.57435978911717 L 547.3400967717171 64.57435978911717 L 547.3400967717171 188.99619938278198 Z L 546.76053866148 188.99619938278198 L 552.6275967717172 188.99619938278198 L 552.6275967717172 188.99619938278198 L 552.6275967717172 188.99619938278198 L 552.6275967717172 188.99619938278198 L 552.6275967717172 188.99619938278198 L 546.76053866148 188.99619938278198 Z"
                                                cy="64.57335978911716" cx="598.2075927297275" j="10" val="79"
                                                barHeight="124.42183959366481" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2635"
                                                d="M 599.2075927297275 188.99619938278198 L 599.2075927297275 116.54803961938222 L 605.0746508399646 116.54803961938222 L 605.0746508399646 188.99619938278198 Z"
                                                fill="rgba(249,58,90,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 599.2075927297275 188.99619938278198 L 599.2075927297275 116.54803961938222 L 605.0746508399646 116.54803961938222 L 605.0746508399646 188.99619938278198 Z"
                                                pathFrom="M 593.4950927297274 188.99619938278198 L 593.4950927297274 116.54803961938222 L 599.2871508399645 116.54803961938222 L 599.2871508399645 188.99619938278198 Z L 599.2075927297275 188.99619938278198 L 605.0746508399646 188.99619938278198 L 605.0746508399646 188.99619938278198 L 605.0746508399646 188.99619938278198 L 605.0746508399646 188.99619938278198 L 605.0746508399646 188.99619938278198 L 599.2075927297275 188.99619938278198 Z"
                                                cy="116.54703961938222" cx="650.6546467979749" j="11" val="46"
                                                barHeight="72.44815976339976" barWidth="7.867058110237122"></path>
                                            <g id="SvgjsG2610" class="apexcharts-bar-goals-markers">
                                                <g id="SvgjsG2612" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2614" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2616" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2618" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2620" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2622" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2624" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2626" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2628" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2630" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2632" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2634" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                            </g>
                                            <g id="SvgjsG2611"
                                                class="apexcharts-bar-shadows apexcharts-hidden-element-shown"></g>
                                        </g>
                                        <g id="SvgjsG2636" class="apexcharts-series" rel="3" seriesName="Inxprogress"
                                            data:realIndex="2">
                                            <path id="SvgjsPath2641"
                                                d="M 30.157056089242296 188.99619938278198 L 30.157056089242296 148.04723951651255 L 36.02411419947942 148.04723951651255 L 36.02411419947942 188.99619938278198 Z"
                                                fill="rgba(247,165,86,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 30.157056089242296 188.99619938278198 L 30.157056089242296 148.04723951651255 L 36.02411419947942 148.04723951651255 L 36.02411419947942 188.99619938278198 Z"
                                                pathFrom="M 29.869556089242298 188.99619938278198 L 29.869556089242298 148.04723951651255 L 35.661614199479416 148.04723951651255 L 35.661614199479416 188.99619938278198 Z L 30.157056089242296 188.99619938278198 L 36.02411419947942 188.99619938278198 L 36.02411419947942 188.99619938278198 L 36.02411419947942 188.99619938278198 L 36.02411419947942 188.99619938278198 L 36.02411419947942 188.99619938278198 L 30.157056089242296 188.99619938278198 Z"
                                                cy="148.04623951651254" cx="81.60411015748977" j="0" val="26"
                                                barHeight="40.94895986626943" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2643"
                                                d="M 82.60411015748977 188.99619938278198 L 82.60411015748977 133.8725995628039 L 88.4711682677269 133.8725995628039 L 88.4711682677269 188.99619938278198 Z"
                                                fill="rgba(247,165,86,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 82.60411015748977 188.99619938278198 L 82.60411015748977 133.8725995628039 L 88.4711682677269 133.8725995628039 L 88.4711682677269 188.99619938278198 Z"
                                                pathFrom="M 81.81661015748978 188.99619938278198 L 81.81661015748978 133.8725995628039 L 87.6086682677269 133.8725995628039 L 87.6086682677269 188.99619938278198 Z L 82.60411015748977 188.99619938278198 L 88.4711682677269 188.99619938278198 L 88.4711682677269 188.99619938278198 L 88.4711682677269 188.99619938278198 L 88.4711682677269 188.99619938278198 L 88.4711682677269 188.99619938278198 L 82.60411015748977 188.99619938278198 Z"
                                                cy="133.8715995628039" cx="134.05116422573724" j="1" val="35"
                                                barHeight="55.12359981997808" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2645"
                                                d="M 135.05116422573724 188.99619938278198 L 135.05116422573724 124.4228395936648 L 140.91822233597435 124.4228395936648 L 140.91822233597435 188.99619938278198 Z"
                                                fill="rgba(247,165,86,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 135.05116422573724 188.99619938278198 L 135.05116422573724 124.4228395936648 L 140.91822233597435 124.4228395936648 L 140.91822233597435 188.99619938278198 Z"
                                                pathFrom="M 133.76366422573724 188.99619938278198 L 133.76366422573724 124.4228395936648 L 139.55572233597437 124.4228395936648 L 139.55572233597437 188.99619938278198 Z L 135.05116422573724 188.99619938278198 L 140.91822233597435 188.99619938278198 L 140.91822233597435 188.99619938278198 L 140.91822233597435 188.99619938278198 L 140.91822233597435 188.99619938278198 L 140.91822233597435 188.99619938278198 L 135.05116422573724 188.99619938278198 Z"
                                                cy="124.4218395936648" cx="186.4982182939847" j="2" val="41"
                                                barHeight="64.57335978911718" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2647"
                                                d="M 187.4982182939847 188.99619938278198 L 187.4982182939847 66.14931978397368 L 193.36527640422182 66.14931978397368 L 193.36527640422182 188.99619938278198 Z"
                                                fill="rgba(247,165,86,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 187.4982182939847 188.99619938278198 L 187.4982182939847 66.14931978397368 L 193.36527640422182 66.14931978397368 L 193.36527640422182 188.99619938278198 Z"
                                                pathFrom="M 185.7107182939847 188.99619938278198 L 185.7107182939847 66.14931978397368 L 191.50277640422183 66.14931978397368 L 191.50277640422183 188.99619938278198 Z L 187.4982182939847 188.99619938278198 L 193.36527640422182 188.99619938278198 L 193.36527640422182 188.99619938278198 L 193.36527640422182 188.99619938278198 L 193.36527640422182 188.99619938278198 L 193.36527640422182 188.99619938278198 L 187.4982182939847 188.99619938278198 Z"
                                                cy="66.14831978397368" cx="238.94527236223217" j="3" val="78"
                                                barHeight="122.8468795988083" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2649"
                                                d="M 239.94527236223217 188.99619938278198 L 239.94527236223217 135.4475595576604 L 245.81233047246928 135.4475595576604 L 245.81233047246928 188.99619938278198 Z"
                                                fill="rgba(247,165,86,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 239.94527236223217 188.99619938278198 L 239.94527236223217 135.4475595576604 L 245.81233047246928 135.4475595576604 L 245.81233047246928 188.99619938278198 Z"
                                                pathFrom="M 237.65777236223218 188.99619938278198 L 237.65777236223218 135.4475595576604 L 243.4498304724693 135.4475595576604 L 243.4498304724693 188.99619938278198 Z L 239.94527236223217 188.99619938278198 L 245.81233047246928 188.99619938278198 L 245.81233047246928 188.99619938278198 L 245.81233047246928 188.99619938278198 L 245.81233047246928 188.99619938278198 L 245.81233047246928 188.99619938278198 L 239.94527236223217 188.99619938278198 Z"
                                                cy="135.4465595576604" cx="291.3923264304796" j="4" val="34"
                                                barHeight="53.54863982512156" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2651"
                                                d="M 292.3923264304796 188.99619938278198 L 292.3923264304796 86.6237997171084 L 298.2593845407167 86.6237997171084 L 298.2593845407167 188.99619938278198 Z"
                                                fill="rgba(247,165,86,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 292.3923264304796 188.99619938278198 L 292.3923264304796 86.6237997171084 L 298.2593845407167 86.6237997171084 L 298.2593845407167 188.99619938278198 Z"
                                                pathFrom="M 289.60482643047965 188.99619938278198 L 289.60482643047965 86.6237997171084 L 295.39688454071677 86.6237997171084 L 295.39688454071677 188.99619938278198 Z L 292.3923264304796 188.99619938278198 L 298.2593845407167 188.99619938278198 L 298.2593845407167 188.99619938278198 L 298.2593845407167 188.99619938278198 L 298.2593845407167 188.99619938278198 L 298.2593845407167 188.99619938278198 L 292.3923264304796 188.99619938278198 Z"
                                                cy="86.62279971710839" cx="343.8393804987271" j="5" val="65"
                                                barHeight="102.37239966567358" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2653"
                                                d="M 344.8393804987271 188.99619938278198 L 344.8393804987271 146.47227952165602 L 350.7064386089642 146.47227952165602 L 350.7064386089642 188.99619938278198 Z"
                                                fill="rgba(247,165,86,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 344.8393804987271 188.99619938278198 L 344.8393804987271 146.47227952165602 L 350.7064386089642 146.47227952165602 L 350.7064386089642 188.99619938278198 Z"
                                                pathFrom="M 341.55188049872714 188.99619938278198 L 341.55188049872714 146.47227952165602 L 347.34393860896427 146.47227952165602 L 347.34393860896427 188.99619938278198 Z L 344.8393804987271 188.99619938278198 L 350.7064386089642 188.99619938278198 L 350.7064386089642 188.99619938278198 L 350.7064386089642 188.99619938278198 L 350.7064386089642 188.99619938278198 L 350.7064386089642 188.99619938278198 L 344.8393804987271 188.99619938278198 Z"
                                                cy="146.47127952165602" cx="396.2864345669746" j="6" val="27"
                                                barHeight="42.52391986112595" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2655"
                                                d="M 397.2864345669746 188.99619938278198 L 397.2864345669746 116.54803961938222 L 403.1534926772117 116.54803961938222 L 403.1534926772117 188.99619938278198 Z"
                                                fill="rgba(247,165,86,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 397.2864345669746 188.99619938278198 L 397.2864345669746 116.54803961938222 L 403.1534926772117 116.54803961938222 L 403.1534926772117 188.99619938278198 Z"
                                                pathFrom="M 393.49893456697464 188.99619938278198 L 393.49893456697464 116.54803961938222 L 399.29099267721176 116.54803961938222 L 399.29099267721176 188.99619938278198 Z L 397.2864345669746 188.99619938278198 L 403.1534926772117 188.99619938278198 L 403.1534926772117 188.99619938278198 L 403.1534926772117 188.99619938278198 L 403.1534926772117 188.99619938278198 L 403.1534926772117 188.99619938278198 L 397.2864345669746 188.99619938278198 Z"
                                                cy="116.54703961938222" cx="448.7334886352221" j="7" val="46"
                                                barHeight="72.44815976339976" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2657"
                                                d="M 449.7334886352221 188.99619938278198 L 449.7334886352221 130.72267957309086 L 455.6005467454592 130.72267957309086 L 455.6005467454592 188.99619938278198 Z"
                                                fill="rgba(247,165,86,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 449.7334886352221 188.99619938278198 L 449.7334886352221 130.72267957309086 L 455.6005467454592 130.72267957309086 L 455.6005467454592 188.99619938278198 Z"
                                                pathFrom="M 445.44598863522214 188.99619938278198 L 445.44598863522214 130.72267957309086 L 451.23804674545926 130.72267957309086 L 451.23804674545926 188.99619938278198 Z L 449.7334886352221 188.99619938278198 L 455.6005467454592 188.99619938278198 L 455.6005467454592 188.99619938278198 L 455.6005467454592 188.99619938278198 L 455.6005467454592 188.99619938278198 L 455.6005467454592 188.99619938278198 L 449.7334886352221 188.99619938278198 Z"
                                                cy="130.72167957309085" cx="501.1805427034696" j="8" val="37"
                                                barHeight="58.273519809691116" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2659"
                                                d="M 502.1805427034696 188.99619938278198 L 502.1805427034696 86.6237997171084 L 508.0476008137067 86.6237997171084 L 508.0476008137067 188.99619938278198 Z"
                                                fill="rgba(247,165,86,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 502.1805427034696 188.99619938278198 L 502.1805427034696 86.6237997171084 L 508.0476008137067 86.6237997171084 L 508.0476008137067 188.99619938278198 Z"
                                                pathFrom="M 497.39304270346963 188.99619938278198 L 497.39304270346963 86.6237997171084 L 503.18510081370675 86.6237997171084 L 503.18510081370675 188.99619938278198 Z L 502.1805427034696 188.99619938278198 L 508.0476008137067 188.99619938278198 L 508.0476008137067 188.99619938278198 L 508.0476008137067 188.99619938278198 L 508.0476008137067 188.99619938278198 L 508.0476008137067 188.99619938278198 L 502.1805427034696 188.99619938278198 Z"
                                                cy="86.62279971710839" cx="553.6275967717171" j="9" val="65"
                                                barHeight="102.37239966567358" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2661"
                                                d="M 554.6275967717171 188.99619938278198 L 554.6275967717171 111.82315963481267 L 560.4946548819543 111.82315963481267 L 560.4946548819543 188.99619938278198 Z"
                                                fill="rgba(247,165,86,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 554.6275967717171 188.99619938278198 L 554.6275967717171 111.82315963481267 L 560.4946548819543 111.82315963481267 L 560.4946548819543 188.99619938278198 Z"
                                                pathFrom="M 549.3400967717171 188.99619938278198 L 549.3400967717171 111.82315963481267 L 555.1321548819542 111.82315963481267 L 555.1321548819542 188.99619938278198 Z L 554.6275967717171 188.99619938278198 L 560.4946548819543 188.99619938278198 L 560.4946548819543 188.99619938278198 L 560.4946548819543 188.99619938278198 L 560.4946548819543 188.99619938278198 L 560.4946548819543 188.99619938278198 L 554.6275967717171 188.99619938278198 Z"
                                                cy="111.82215963481266" cx="606.0746508399645" j="10" val="49"
                                                barHeight="77.17303974796931" barWidth="7.867058110237122"></path>
                                            <path id="SvgjsPath2663"
                                                d="M 607.0746508399645 188.99619938278198 L 607.0746508399645 152.7721195010821 L 612.9417089502017 152.7721195010821 L 612.9417089502017 188.99619938278198 Z"
                                                fill="rgba(247,165,86,1)" fill-opacity="1" stroke="transparent"
                                                stroke-opacity="1" stroke-linecap="round" stroke-width="2"
                                                stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                clip-path="url(#gridRectMask7j11wuy4)"
                                                pathTo="M 607.0746508399645 188.99619938278198 L 607.0746508399645 152.7721195010821 L 612.9417089502017 152.7721195010821 L 612.9417089502017 188.99619938278198 Z"
                                                pathFrom="M 601.2871508399645 188.99619938278198 L 601.2871508399645 152.7721195010821 L 607.0792089502016 152.7721195010821 L 607.0792089502016 188.99619938278198 Z L 607.0746508399645 188.99619938278198 L 612.9417089502017 188.99619938278198 L 612.9417089502017 188.99619938278198 L 612.9417089502017 188.99619938278198 L 612.9417089502017 188.99619938278198 L 612.9417089502017 188.99619938278198 L 607.0746508399645 188.99619938278198 Z"
                                                cy="152.7711195010821" cx="658.521704908212" j="11" val="23"
                                                barHeight="36.22407988169988" barWidth="7.867058110237122"></path>
                                            <g id="SvgjsG2638" class="apexcharts-bar-goals-markers">
                                                <g id="SvgjsG2640" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2642" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2644" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2646" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2648" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2650" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2652" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2654" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2656" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2658" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2660" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                                <g id="SvgjsG2662" className="apexcharts-bar-goals-groups"
                                                    class="apexcharts-hidden-element-shown"
                                                    clip-path="url(#gridRectMarkerMask7j11wuy4)"></g>
                                            </g>
                                            <g id="SvgjsG2639"
                                                class="apexcharts-bar-shadows apexcharts-hidden-element-shown"></g>
                                        </g>
                                        <g id="SvgjsG2581" class="apexcharts-datalabels apexcharts-hidden-element-shown"
                                            data:realIndex="0"></g>
                                        <g id="SvgjsG2609" class="apexcharts-datalabels apexcharts-hidden-element-shown"
                                            data:realIndex="1"></g>
                                        <g id="SvgjsG2637" class="apexcharts-datalabels apexcharts-hidden-element-shown"
                                            data:realIndex="2"></g>
                                    </g>
                                    <line id="SvgjsLine2675" x1="0" y1="0" x2="629.3646488189697" y2="0"
                                        stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                        class="apexcharts-ycrosshairs"></line>
                                    <line id="SvgjsLine2676" x1="0" y1="0" x2="629.3646488189697" y2="0"
                                        stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                        class="apexcharts-ycrosshairs-hidden"></line>
                                    <g id="SvgjsG2677" class="apexcharts-xaxis" transform="translate(0, 0)">
                                        <g id="SvgjsG2678" class="apexcharts-xaxis-texts-g"
                                            transform="translate(0, -4)">
                                            <text id="SvgjsText2680" font-family="Nunito, sans-serif"
                                                x="26.223527034123737" y="217.99519938278198" text-anchor="middle"
                                                dominant-baseline="auto" font-size="12px" font-weight="400"
                                                fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: Nunito, sans-serif;">
                                                <tspan id="SvgjsTspan2681">Jan</tspan>
                                                <title>Jan</title>
                                            </text><text id="SvgjsText2683" font-family="Nunito, sans-serif"
                                                x="78.67058110237122" y="217.99519938278198" text-anchor="middle"
                                                dominant-baseline="auto" font-size="12px" font-weight="400"
                                                fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: Nunito, sans-serif;">
                                                <tspan id="SvgjsTspan2684">Feb</tspan>
                                                <title>Feb</title>
                                            </text><text id="SvgjsText2686" font-family="Nunito, sans-serif"
                                                x="131.11763517061868" y="217.99519938278198" text-anchor="middle"
                                                dominant-baseline="auto" font-size="12px" font-weight="400"
                                                fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: Nunito, sans-serif;">
                                                <tspan id="SvgjsTspan2687">Mar</tspan>
                                                <title>Mar</title>
                                            </text><text id="SvgjsText2689" font-family="Nunito, sans-serif"
                                                x="183.56468923886615" y="217.99519938278198" text-anchor="middle"
                                                dominant-baseline="auto" font-size="12px" font-weight="400"
                                                fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: Nunito, sans-serif;">
                                                <tspan id="SvgjsTspan2690">Apr</tspan>
                                                <title>Apr</title>
                                            </text><text id="SvgjsText2692" font-family="Nunito, sans-serif"
                                                x="236.01174330711362" y="217.99519938278198" text-anchor="middle"
                                                dominant-baseline="auto" font-size="12px" font-weight="400"
                                                fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: Nunito, sans-serif;">
                                                <tspan id="SvgjsTspan2693">May</tspan>
                                                <title>May</title>
                                            </text><text id="SvgjsText2695" font-family="Nunito, sans-serif"
                                                x="288.45879737536114" y="217.99519938278198" text-anchor="middle"
                                                dominant-baseline="auto" font-size="12px" font-weight="400"
                                                fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: Nunito, sans-serif;">
                                                <tspan id="SvgjsTspan2696">Jun</tspan>
                                                <title>Jun</title>
                                            </text><text id="SvgjsText2698" font-family="Nunito, sans-serif"
                                                x="340.90585144360864" y="217.99519938278198" text-anchor="middle"
                                                dominant-baseline="auto" font-size="12px" font-weight="400"
                                                fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: Nunito, sans-serif;">
                                                <tspan id="SvgjsTspan2699">Jul</tspan>
                                                <title>Jul</title>
                                            </text><text id="SvgjsText2701" font-family="Nunito, sans-serif"
                                                x="393.35290551185614" y="217.99519938278198" text-anchor="middle"
                                                dominant-baseline="auto" font-size="12px" font-weight="400"
                                                fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: Nunito, sans-serif;">
                                                <tspan id="SvgjsTspan2702">Aug</tspan>
                                                <title>Aug</title>
                                            </text><text id="SvgjsText2704" font-family="Nunito, sans-serif"
                                                x="445.79995958010363" y="217.99519938278198" text-anchor="middle"
                                                dominant-baseline="auto" font-size="12px" font-weight="400"
                                                fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: Nunito, sans-serif;">
                                                <tspan id="SvgjsTspan2705">Sep</tspan>
                                                <title>Sep</title>
                                            </text><text id="SvgjsText2707" font-family="Nunito, sans-serif"
                                                x="498.2470136483511" y="217.99519938278198" text-anchor="middle"
                                                dominant-baseline="auto" font-size="12px" font-weight="400"
                                                fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: Nunito, sans-serif;">
                                                <tspan id="SvgjsTspan2708">Oct</tspan>
                                                <title>Oct</title>
                                            </text><text id="SvgjsText2710" font-family="Nunito, sans-serif"
                                                x="550.6940677165985" y="217.99519938278198" text-anchor="middle"
                                                dominant-baseline="auto" font-size="12px" font-weight="400"
                                                fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: Nunito, sans-serif;">
                                                <tspan id="SvgjsTspan2711">Nov</tspan>
                                                <title>Nov</title>
                                            </text><text id="SvgjsText2713" font-family="Nunito, sans-serif"
                                                x="603.141121784846" y="217.99519938278198" text-anchor="middle"
                                                dominant-baseline="auto" font-size="12px" font-weight="400"
                                                fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                style="font-family: Nunito, sans-serif;">
                                                <tspan id="SvgjsTspan2714">Dec</tspan>
                                                <title>Dec</title>
                                            </text>
                                        </g>
                                    </g>
                                    <g id="SvgjsG2732" class="apexcharts-yaxis-annotations"></g>
                                    <g id="SvgjsG2733" class="apexcharts-xaxis-annotations"></g>
                                    <g id="SvgjsG2734" class="apexcharts-point-annotations"></g>
                                </g>
                            </svg>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div> <!-- row closed -->
    <!-- row opened -->
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header pb-1">
                    <h3 class="card-title mb-2">Purchase Activity</h3>
                    <p class="fs-12 mb-0 text-muted">Purchase activities are the tactics that vendor use to
                        achieve their goals and objective</p>
                </div>
                <div class="product-timeline card-body pt-2 mt-1">
                    <ul class="timeline-1 mb-0">
                        <li class="mt-0"> <i
                                class="fe fe-pie-chart bg-primary-gradient text-fixed-white product-icon"></i>
                            <span class="fw-medium mb-4 fs-14">Total Products</span> <a href="javascript:void(0);"
                                class="float-end fs-11 text-muted">3 days ago</a>
                            <p class="mb-0 text-muted fs-12">1.3k New Products</p>
                        </li>
                        <li class="mt-0"> <i
                                class="fe fe-shopping-cart bg-danger-gradient text-fixed-white product-icon"></i>
                            <span class="fw-medium mb-4 fs-14">Total Sales</span> <a href="javascript:void(0);"
                                class="float-end fs-11 text-muted">35 mins ago</a>
                            <p class="mb-0 text-muted fs-12">1k New Sales</p>
                        </li>
                        <li class="mt-0"> <i
                                class="fe fe-bar-chart bg-success-gradient text-fixed-white product-icon"></i>
                            <span class="fw-medium mb-4 fs-14">Total Revenue</span> <a href="javascript:void(0);"
                                class="float-end fs-11 text-muted">50 mins ago</a>
                            <p class="mb-0 text-muted fs-12">23.5K New Revenue</p>
                        </li>
                        <li class="mt-0"> <i class="fe fe-box bg-warning-gradient text-fixed-white product-icon"></i>
                            <span class="fw-medium mb-4 fs-14">Total Profit</span> <a href="javascript:void(0);"
                                class="float-end fs-11 text-muted">1 hour ago</a>
                            <p class="mb-0 text-muted fs-12">3k New profit</p>
                        </li>
                        <li class="mt-0"> <i class="fe fe-eye bg-purple-gradient text-fixed-white product-icon"></i>
                            <span class="fw-medium mb-4 fs-14">Customer Visits</span> <a href="javascript:void(0);"
                                class="float-end fs-11 text-muted">1 day ago</a>
                            <p class="mb-0 text-muted fs-12">15% increased</p>
                        </li>
                        <li class="mt-0 mb-0"> <i
                                class="fe fe-edit bg-primary-gradient text-fixed-white product-icon"></i>
                            <span class="fw-medium mb-4 fs-14">Customer Reviews</span> <a href="javascript:void(0);"
                                class="float-end fs-11 text-muted">1 day ago</a>
                            <p class="mb-0 text-muted fs-12">1.5k reviews</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header pb-0">
                    <h3 class="card-title mb-2">Recent Orders</h3>
                    <p class="fs-12 mb-0 text-muted">An order is an investor's instructions to a broker or brokerage
                        firm to purchase or sell</p>
                </div>
                <div class="card-body sales-info pb-0 pt-0">
                    <div id="chart" class="ht-150" style="min-height: 156.9px;">
                        <div id="apexchartsjhrebmpk" class="apexcharts-canvas apexchartsjhrebmpk apexcharts-theme-light"
                            style="width: 200px; height: 156.9px;"><svg id="SvgjsSvg3266" width="200"
                                height="156.89999999999998" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                style="background: transparent;">
                                <foreignObject x="0" y="0" width="200" height="156.89999999999998">
                                    <div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"></div>
                                </foreignObject>
                                <g id="SvgjsG3268" class="apexcharts-inner apexcharts-graphical"
                                    transform="translate(10.5, 0)">
                                    <defs id="SvgjsDefs3267">
                                        <clipPath id="gridRectMaskjhrebmpk">
                                            <rect id="SvgjsRect3269" width="187" height="205" x="-3" y="-1" rx="0"
                                                ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                                fill="#fff">
                                            </rect>
                                        </clipPath>
                                        <clipPath id="forecastMaskjhrebmpk"></clipPath>
                                        <clipPath id="nonForecastMaskjhrebmpk"></clipPath>
                                        <clipPath id="gridRectMarkerMaskjhrebmpk">
                                            <rect id="SvgjsRect3270" width="185" height="207" x="-2" y="-2" rx="0"
                                                ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"
                                                fill="#fff">
                                            </rect>
                                        </clipPath>
                                        <linearGradient id="SvgjsLinearGradient3275" x1="0" y1="1" x2="1" y2="1">
                                            <stop id="SvgjsStop3276" stop-opacity="1" stop-color="rgba(1,98,232,1)"
                                                offset="0"></stop>
                                            <stop id="SvgjsStop3277" stop-opacity="1" stop-color="rgba(236,240,250,1)"
                                                offset="1"></stop>
                                            <stop id="SvgjsStop3278" stop-opacity="1" stop-color="rgba(236,240,250,1)"
                                                offset="1"></stop>
                                        </linearGradient>
                                        <linearGradient id="SvgjsLinearGradient3286" x1="0" y1="1" x2="1" y2="1">
                                            <stop id="SvgjsStop3287" stop-opacity="1" stop-color="rgba(1,98,232,1)"
                                                offset="0"></stop>
                                            <stop id="SvgjsStop3288" stop-opacity="1" stop-color="rgba(13,178,222,1)"
                                                offset="1"></stop>
                                            <stop id="SvgjsStop3289" stop-opacity="1" stop-color="rgba(13,178,222,1)"
                                                offset="1"></stop>
                                        </linearGradient>
                                    </defs>
                                    <g id="SvgjsG3271" class="apexcharts-radialbar">
                                        <g id="SvgjsG3272">
                                            <g id="SvgjsG3273" class="apexcharts-tracks">
                                                <g id="SvgjsG3274" class="apexcharts-radialbar-track apexcharts-track"
                                                    rel="1">
                                                    <path id="apexcharts-radialbarTrack-0"
                                                        d="M 52.3636617097865 128.6363382902135 A 53.9329268292683 53.9329268292683 0 1 1 128.6363382902135 128.6363382902135"
                                                        fill="none" fill-opacity="1" stroke="rgba(236,240,250,0.85)"
                                                        stroke-opacity="1" stroke-linecap="butt"
                                                        stroke-width="12.458536585365856" stroke-dasharray="0"
                                                        class="apexcharts-radialbar-area"
                                                        data:pathOrig="M 52.3636617097865 128.6363382902135 A 53.9329268292683 53.9329268292683 0 1 1 128.6363382902135 128.6363382902135">
                                                    </path>
                                                </g>
                                            </g>
                                            <g id="SvgjsG3280">
                                                <g id="SvgjsG3285" class="apexcharts-series apexcharts-radial-series"
                                                    seriesName="" rel="1" data:realIndex="0">
                                                    <path id="SvgjsPath3290"
                                                        d="M 52.3636617097865 128.6363382902135 A 53.9329268292683 53.9329268292683 0 1 1 144.4247125832822 89.55874064062334"
                                                        fill="none" fill-opacity="0.85"
                                                        stroke="url(#SvgjsLinearGradient3286)" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="15.573170731707318"
                                                        stroke-dasharray="4"
                                                        class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                        data:angle="224" data:value="83" index="0" j="0"
                                                        data:pathOrig="M 52.3636617097865 128.6363382902135 A 53.9329268292683 53.9329268292683 0 1 1 144.4247125832822 89.55874064062334">
                                                    </path>
                                                </g>
                                                <circle id="SvgjsCircle3281" r="42.703658536585365" cx="90.5" cy="90.5"
                                                    class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                                                <g id="SvgjsG3282" class="apexcharts-datalabels-group"
                                                    transform="translate(0, 0) scale(1)" style="opacity: 1;"><text
                                                        id="SvgjsText3283" font-family="Helvetica, Arial, sans-serif"
                                                        x="90.5" y="120.5" text-anchor="middle" dominant-baseline="auto"
                                                        font-size="16px" font-weight="600" fill="#0db2de"
                                                        class="apexcharts-text apexcharts-datalabel-label"
                                                        style="font-family: Helvetica, Arial, sans-serif;"></text><text
                                                        id="SvgjsText3284" font-family="Helvetica, Arial, sans-serif"
                                                        x="90.5" y="96.5" text-anchor="middle" dominant-baseline="auto"
                                                        font-size="22px" font-weight="400" fill="#373d3f"
                                                        class="apexcharts-text apexcharts-datalabel-value"
                                                        style="font-family: Helvetica, Arial, sans-serif;">83%</text>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                    <line id="SvgjsLine3291" x1="0" y1="0" x2="181" y2="0" stroke="#b6b6b6"
                                        stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                        class="apexcharts-ycrosshairs"></line>
                                    <line id="SvgjsLine3292" x1="0" y1="0" x2="181" y2="0" stroke-dasharray="0"
                                        stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden">
                                    </line>
                                </g>
                            </svg></div>
                    </div>
                    <div class="row sales-infomation pb-0 mb-0 mx-auto w-100">
                        <div class="col-md-6 col">
                            <p class="mb-0 d-flex"><span class="legend bg-primary brround"></span>Delivered</p>
                            <h3 class="mb-1">5238</h3>
                            <div class="d-flex">
                                <p class="text-muted ">Last 6 months</p>
                            </div>
                        </div>
                        <div class="col-md-6 col">
                            <p class="mb-0 d-flex"><span class="legend bg-info brround"></span>Cancelled</p>
                            <h3 class="mb-1">3467</h3>
                            <div class="d-flex">
                                <p class="text-muted">Last 6 months</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center pb-2">
                                <p class="mb-0">Total Sales</p>
                            </div>
                            <h4 class="fw-bold mb-2">$7,590</h4>
                            <div class="progress progress-style progress-sm">
                                <div class="progress-bar bg-primary-gradient" style="width: 80%" role="progressbar"
                                    aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="d-flex align-items-center pb-2">
                                <p class="mb-0">Active Users</p>
                            </div>
                            <h4 class="fw-bold mb-2">$5,460</h4>
                            <div class="progress progress-style progress-sm">
                                <div class="progress-bar bg-danger-gradient" style="width: 45%" role="progressbar"
                                    aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row close -->

</div>