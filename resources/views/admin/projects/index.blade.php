@extends('layouts.admin')

@section('content')
    <header class="py-3 bg-primary">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="text-white">Projects</h1>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-dark"><i class="fa fa-pencil" aria-hidden="true"></i>
                Create new project</a>
        </div>
    </header>

    <section class="py-5">
        <div class="container-xxl">

            <h3 class="">All projects</h3>

            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('message') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">ID</th>
                            <th scope="col" class="text-center">Project Image</th>
                            <th scope="col" class="text-center">Title</th>
                            <th scope="col" class="text-center">Slug</th>
                            <th scope="col" class="text-center">Link</th>
                            <th scope="col" class="text-center">GitHub</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                            <tr class="">
                                <td scope="row" class="text-center">{{ $project->id }}</td>
                                <td class="text-center">
                                    @if (Str::startsWith($project->project_img, 'https://'))
                                        <img src="{{ $project->project_img }}" alt="{{ $project->title }}" width="100">
                                    @else
                                        <img src="{{ asset('storage/' . $project->project_img) }}"
                                            alt="{{ $project->title }}" width="100">
                                    @endif
                                </td>
                                <td class="text-center">{{ $project->title }}</td>
                                <td class="text-center">{{ $project->slug }}</td>
                                <td class="text-center">{{ $project->project_link }}</td>
                                <td class="text-center">{{ $project->project_github }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-primary">Show <i
                                            class="fa fa-eye" aria-hidden="true"></i></a>

                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary">Edit <i
                                            class="fa-solid fa-pen-to-square"></i></a>

                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $project->id }}">
                                        Delete <i class="fa-solid fa-gavel"></i>
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId-{{ $project->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId-{{ $project->id }}">
                                                        ATTENTION! Deleting : {{ $project->title }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ❌ Attention!! You are aboute to delete this record!
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <form action="{{ route('admin.projects.destroy', $project) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            Confirm
                                                            <i class="fa-solid fa-rectangle-xmark"></i>
                                                        </button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="">
                                <td scope="row" colspan="5">Nothing to display</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>
        <!-- /.container -->
    </section>
@endsection
