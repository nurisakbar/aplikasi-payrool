<?php
function tab_active($url)
{
     echo Request::segment(3)==$url?'class="active"':'';
}
?>

<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li {{ tab_active('edit') }}><a href="/karyawan/{{ Request::segment(2) }}/edit">
          <i class="fa fa-user" aria-hidden="true"></i> Data Karyawan</a>
        </li>
        <li {{ tab_active('polakerja') }}><a href="/karyawan/{{ Request::segment(2) }}/polakerja">
          <i class="fa fa-calendar" aria-hidden="true"></i> Pola Kerja</a></li>
        <li {{ tab_active('kehadiran') }}><a href="/karyawan/{{ Request::segment(2) }}/kehadiran">
          <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Riwayat Kehadiran</a></li>
        <li {{ tab_active('lembur') }}><a href="/karyawan/{{ Request::segment(2) }}/lembur">
          <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Riwayat Lembur</a></li>
    </ul>
<!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->