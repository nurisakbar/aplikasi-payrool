@extends('template')
@section('title','Detail Gaji Karyawan')
@section('content')

    @include('validation')

    @include('alert')

    <div class="row">
        <div class="col-md-4">
                <table class="table table-bordered">
                    <tr>
                        <td><img src="{{ asset('uploads/'.$karyawan->foto)}}" width="180"></td>
                    </tr>
                    <tr>
                        <td>{{ $karyawan->nama}}</td>
                    </tr>
                    </table>
        </div>
        <div class="col-md-8">
            {{ Form::open(['url'=>'tambah-komponen-gaji-detail'])}}
            {{ Form::hidden('gaji_id',$gaji->id)}}
            <table class="table table-bordered">
                <tr>
                    <td>{{ Form::select('kode_komponen',$komponenGaji,null,['class'=>'form-control'])}}</td>
                    <td><button type="submit" class="btn btn-danger">Tambah Komponen</button></td>
                </tr>
            </table>
            {{ Form::close()}}
            <table class="table table-bordered">
                <tr>
                    <th>Komponen Gaji</th>
                    <th>Nominal</th>
                    <th>Jenis</th>
                    <th></th>
                </tr>
                <tr>
                    <td>Gaji Pokok</td>
                    <td>{{ $karyawan->gaji_pokok }}</td>
                    <td>Tetap</td>
                </tr>
                <tr>
                    <td>Tunjangan Jabatan</td>
                    <td>{{ $karyawan->tunjangan_jabatan }}</td>
                    <td>Tunjangan</td>
                    <td></td>
                </tr>

                <?php
                $pendapatan_tambahan = 0;
                ?>
                @if(isset($gajiDetail))
                    @foreach($gajiDetail as $gd)
                        <tr>
                            <td>{{ $gd->nama_komponen }}</td>
                            <td>{{ $gd->nilai}}</td>
                            <td>{{ $gd->jenis}}</td>
                            <td>
                                {{ Form::open(['url'=>'hapus-komponen-gaji-detail/'.$gd->id,'method'=>'delete'])}}
                                 <button type="submit" class="btn btn-danger">Hapus</button>
                                {{ Form::close()}}
                            </td>
                        </tr>
                        <?php
                        if($gd->jenis=='tunjangan')
                        {
                            $pendapatan_tambahan = $pendapatan_tambahan + $gd->nilai;
                        }                        
                        else
                        {
                            $pendapatan_tambahan = $pendapatan_tambahan - $gd->nilai;
                        } 
                        ?>
                    @endforeach
                @endif

                <?php
                $upahLembur = $hitungLembur[0]->durasi_lembur*20000;
                $total = $karyawan->gaji_pokok + $karyawan->tunjangan_jabatan + $pendapatan_tambahan;
                ?>
             <tr>
                 <td>Upah Lembur</td>
             <td>{{ $upahLembur}}</td>
             <td>Tambahan</td>
                </tr>   
            <tr>
                <td>Total Pendapatan</td>
                <td>{{ $total}}</td>
            </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
            <h4>Riwayat Kehadiran Dan Lembur</h4>
    
            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <?php
                    $month = substr($periode,5,2);
                    $year = substr($periode,0,4);

                    for($d=1; $d<=31; $d++)
                    {
                        $time=mktime(12, 0, 0, $month, $d, $year);          
                        if (date('m', $time)==$month)       
                            //$list[]=date('Y-m-d-D', $time);
                            echo "<td>".date('d', $time)."</td>";
                    }
                    ?>
                </tr>
                <tr>
                    <td>Kehadiran</td>
                    <?php
                    $month = substr($periode,5,2);
                    $year = substr($periode,0,4);

                    for($d=1; $d<=31; $d++)
                    {
                        $time=mktime(12, 0, 0, $month, $d, $year);          
                        if (date('m', $time)==$month)       
                            //$list[]=date('Y-m-d-D', $time);
                            echo "<td>".chekKehadiran($karyawan->nik,date('Y-m-d', $time))."</td>";
                    }
                    ?>
                </tr>
                <tr>
                        <td>Lembur</td>
                        <?php
                        $month = substr($periode,5,2);
                        $year = substr($periode,0,4);
    
                        for($d=1; $d<=31; $d++)
                        {
                            $time=mktime(12, 0, 0, $month, $d, $year);          
                            if (date('m', $time)==$month)       
                                //$list[]=date('Y-m-d-D', $time);
                                echo "<td>".chekLembur($karyawan->nik,date('Y-m-d', $time))."</td>";
                        }
                        ?>
                    </tr>
            </table>
        </div>
    </div>
    

@endsection