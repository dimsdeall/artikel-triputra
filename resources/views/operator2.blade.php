@extends('layouts.operator2.operator2')
@section('title', 'Dashboard | Operator2')
@section('content')
<div class="pt-3">
    <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $sacon->count() }}</h3>

                <p>Data Sacon</p>
            </div>
            <div class="icon">
              <i class="fa fa-window-maximize"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $warping->count() }}</h3>

                <p>Data Warping</p>
            </div>
            <div class="icon">
              <i class="fa fa-project-diagram"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
                <h3 class="text-white">{{ $indigo->count() }}</h3>

                <p class="text-white">Data Indigo</p>
            </div>
            <div class="icon">
              <i class="fa fa-sitemap"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $user->count() }}</h3>

                <p>Jumlah User</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-dark">
            <div class="inner">
                <h3>{{ $weaving->count() }}</h3>

                <p>Data Weaving</p>
            </div>
            <div class="icon">
              <i class="fa fa-network-wired"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $greige->count() }}</h3>

                <p>Data Greige</p>
            </div>
            <div class="icon">
              <i class="fa fa-hdd"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
                <h3 class="text-white">{{ $finish->count() }}</h3>

                <p class="text-white">Data Finish</p>
            </div>
            <div class="icon">
              <i class="fa fa-flag"></i>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection