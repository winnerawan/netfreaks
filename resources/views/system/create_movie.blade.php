@extends('layouts.template')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{asset('css/page_master_user_admin.css')}}">

@endsection
@section('page_contents')
<div id="page_master_user_admin">

    <div class="panel">
        <div class="panel-heading">
            <i class="icon-settings"></i>
            &nbsp;
            &nbsp;
            &nbsp;
            CREATE MOVIE
        </div>
        <div class="panel-body">
            <form method="post" action="{{ route('system.createMoviePost') }}" accept-charset="UTF-8"
                autocomplete="off">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label">
                                TITLE
                            </label>
                            <input required type="text" name="title" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label">
                                POSTER
                            </label>
                            <input required type="text" name="poster" class="form-control">

                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="form-label">
                                RATING
                            </label>
                            <input required type="number" name="rating" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="form-label">
                                QUALITY
                            </label>
                            <input required type="text" name="quality" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="form-label">
                                COUNTRY
                            </label>
                            <input required type="text" name="country" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="form-label">
                                Release
                            </label>
                            <input required type="text" name="release" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label">
                                GENRES <sup>Separated with comma (ex: Horror, Action)</sup>
                            </label>
                            <input required type="text" name="genres" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-label">
                                LINK
                            </label>
                            <input required type="text" name="link" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label">
                                SYNOPSIS
                            </label>
                            <textarea rows="3" required type="text" name="synopsis" class="form-control">
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button style="margin-left:8px;padding:11px;" type="submit" class="pull-right btn btn-hive">
                            <i class="icon-check"></i>
                            &nbsp;
                            &nbsp;
                            Simpan
                        </button>
                        &emsp;&nbsp;
                        <a href="{{url()->previous()}}" class="pull-right btn btn-white back">
                            <i class="icon-action-undo"></i>
                            &nbsp;
                            &nbsp;
                            Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection