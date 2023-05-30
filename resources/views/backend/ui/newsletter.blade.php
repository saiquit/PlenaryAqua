@extends('layouts.backend.base')
@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" />
    <style>
        #display_code {
            padding: 1rem;
            border: 1px solid rgb(233, 89, 89);
        }
    </style>
@endpush
@section('main')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h4 class="text-blue h4">List of Sent News Letters</h4>
                {{-- <p>Add class <code>.table</code></p> --}}
            </div>
            <div class="pull-right">
                <button class="btn btn-primary btn-sm scroll-click"class="btn btn-primary" data-toggle="modal"
                    data-target="#create-new-news" type="button">Create New</button>
            </div>
            <div class="modal fade bs-example-modal-lg" id="create-new-news" tabindex="-1" role="dialog"
                aria-labelledby="edit-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="edit-modal-label">
                                Create New Newsletter
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.ui.newsletter_store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="text" name="emails" value="" data-role="tagsinput" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Select Recivers</label>
                                                <select name="receivers[]" class="custom-select2 form-control"
                                                    multiple="multiple" style="width: 100%">
                                                    <option value="customers">Customers</option>
                                                    <option value="subscribers">Subscribers</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <label>HTML CODE</label>
                                                <br>
                                                <span>
                                                    Paste your <code>HTML</code> Here
                                                </span>
                                                <textarea id="newsletter" placeholder="Paste your code here" class="form-control" name="iframe_text" id=""
                                                    cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div id="display_code"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        Save changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Receiver</th>
                    <th scope="col">Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $new)
                    <tr>
                        <th scope="row">{{ $new->id }}</th>
                        <td>{{ $new->sent_to }}</td>
                        <td>{{ Carbon\Carbon::create($new->created_at)->format('d-M-y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('js')
    <script src="{{ asset('static/b/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#newsletter').keyup(function(e) {
                e.preventDefault();
                $('#display_code').html($(this).val());
            });
        });
    </script>
@endpush
