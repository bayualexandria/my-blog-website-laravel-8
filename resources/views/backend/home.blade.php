@extends('layouts.backend.app')

@section('styles')
<link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
@endsection

@section('content')

@include('layouts.backend.sidebar')
<link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

<link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">

@include('layouts.backend.navbar')
<div class="main-content container-fluid">
    <div class="page-title mb-5">
        <h3>Dashboard</h3>
    </div>
    <section class="section">
        <div class="row mb-2 justify-content-center">
            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between align-items-center'>
                                <i data-feather="credit-card" class="text-white"></i>
                                <h3 class='card-title'>Blogs</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p>{{ $blogs->count() }} </p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div class='px-3 py-3 d-flex justify-content-between align-items-center'>
                                <i data-feather="layers" class="text-white"></i>
                                <h3 class='card-title'>Category</h3>
                                <div class="card-right d-flex align-items-center">
                                    <p>{{ $categories->count() }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">New blogs post</h4>
                        <div class="d-flex ">
                            <i data-feather="download"></i>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class='table mb-0' id="table1">
                                <thead>
                                    <tr>
                                        <th>Write</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Date created</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs->take(10) as $blog)
                                    <tr>
                                        <td>{{ $blog->user->name }}</td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->category->name }}</td>
                                        <td>{{ $blog->created_at->diffForHumans() }}</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <div class="card widget-todo">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <h4 class="card-title d-flex">
                            <i class='bx bx-check font-medium-5 pl-25 pr-75'></i>Progress
                        </h4>

                    </div>
                    <div class="card-body px-0 py-1">
                        <table class='table table-borderless'>
                            @foreach ($categories as $category)
                            <tr>
                                <td class='col-3'>{{ $category->name }}</td>
                                <td class='col-6'>
                                    <div class="progress progress-info">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $category->blogs->count() }}%" aria-valuenow="0"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td class='col-3 text-center'>{{ $category->blogs->count() }}%</td>
                            </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('layouts.backend.footer')
@endsection

@section('scripts')
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/vendors/chartjs/Chart.min.js"></script>
<script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
<script src="assets/js/pages/dashboard.js"></script>
@endsection
