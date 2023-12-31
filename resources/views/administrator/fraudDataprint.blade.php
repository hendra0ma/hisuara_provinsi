@include('layouts.partials.head')
@include('layouts.partials.sidebar-fdp')
@include('layouts.partials.header')

<div class="row mt-3">
    <div class="col-lg-4">
        <h1 class="page-title fs-1 mt-2">Dashboard Rekapitung
            <!-- Kota -->
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fraud Data Print
                <!-- Kota -->
            </li>
        </ol>
        <h4 class="fs-4 mt-2 fw-bold">Administrator Election Fraud Data Print (EFDP)</h4>
    </div>
    <div class="col-lg-8 mt-2">
        <div class="row">
            
            <div class="col-lg-4">
                
            </div>
            <div class="col-lg-4 justify-content-end">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <div class="card-title text-white">Total Kecurangan Masuk</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{count($list_suara)}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title text-white">Total Data Tercetak</div>
                    </div>
                    <div class="card-body">
                        <p class="">{{count($print)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h4 class="fs-4 mt-5 fw-bold">{{$title}}  <div>Paten 1 (Teknologi Cetak Kecurangan Pemilu)</div> </h4>
<hr style="border: 1px solid;">

<div class="row" style="margin-top: 30px;">

    @foreach($list_suara as $ls)
    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title text-white">{{$title2}}</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        @if ($ls->profile_photo_path == NULL)
                        <img class="" style="width: 250px;" src="https://ui-avatars.com/api/?name={{ $ls->name }}&color=7F9CF5&background=EBF4FF" alt="img">
                        @else
                        <img class="" style="width: 250px;" src="{{url("/storage/profile-photos/".$ls->profile_photo_path) }}">
                        @endif
                    </div>
                    <div class="col-md">
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold">NIK</div>
                            <div class="col-md">{{$ls->nik}}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Nama</div>
                            <div class="col-md">{{$ls->name}}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold">No Wa</div>
                            <div class="col-md">{{$ls->no_hp}}</div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4 fw-bold">Date</div>
                            <div class="col-md">{{$ls->date}}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md fw-bold">
                                <a href="print/{{ Crypt::encrypt($ls->tps_id)}}" class="btn btn-secondary w-90 fotoKecuranganterverifikasi mt-2 rounded-0" id="Cek">
                                   Print Kecurangan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div id="fotoKecuranganterverifikasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti</h5>
                <button aria-label="Close" class="btn-close bg-danger text-white rounded-0" data-bs-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="container-hukum-verifikasi"></div>
            </div>
        </div>
    </div>
</div>


    <script>
        $('a.fotoKecuranganterverifikasi').on('click', function () {
            let id = $(this).data('id');
            $.ajax({
                url: `{{route('superadmin.ajaxKecuranganTerverifikasi')}}`,
                type: "GET",
                data: {
                    id
                },
                success: function (response) {
                    if (response) {
                        $('#container-hukum-verifikasi').html(response);
                    }
                }
            });
        });

    </script>   
</div>
@include('layouts.partials.footer')
@include('layouts.partials.scripts-bapilu')
@include('layouts.templateCommander.script-command')
