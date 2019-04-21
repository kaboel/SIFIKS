@extends('layouts.adm-app')
@section('content')
    <section class="content-header">
        <h1>
            <a href="{{ url()->previous() }}" class="btn btn-default">
                <i class="fa fa-chevron-left"></i>
            </a>&nbsp;&nbsp;&nbsp;
            Diskusi<small>oleh <b>{{ $data['thread']->user->name }}</b> ( {{ \Illuminate\Support\Str::limit($data['thread']->topic->topic_name, 15) }} )</small><br>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route(session('guard').'.dashboard') }}"><i class="fa fas fa-tachometer-alt"></i> {{ session('role') }}</a></li>
            <li><a href="{{ route(session('guard').'.thread.index', ['query' => "all"]) }}">Diskusi</a></li>
            <li class="active">Edit<small>({{ $data['thread']->id }})</small></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        @include('layouts.inc.messages')

        <div class="box box-widget">
            <div class="box-header with-border">
                <div class="user-block">
                    <img class="img-circle" src="{{ asset('storage/user_images/'.$data['thread']->user->profile_picture) }}" alt="User Image">
                    <span class="username"><a href="#">{{ $data['thread']->user->name  }}</a></span>
                    <span class="description">{{ $data['thread']->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <div class="box-body" style="padding: 15px 30px">
                <h3>{{ $data['thread']->topic->topic_name }}</h3>
                <p>{!!  $data['thread']->question !!}</p>
                <span class="pull-left">
                    <i class="fa fa-check-circle text-primary"></i>
                    Dijawab oleh <b>dr. {{ $data['thread']->doctor->name }}</b>
                </span>
            </div>
            <div class="box-footer box-comments" style="padding: 20px">
                <div class="box-comment">
                    <img class="img-circle img-sm" src="{{ asset('storage/user_images/'.$data['doctor']->profile_picture) }}" alt="User Image">
                    <div class="comment-text">
                        <span class="username">
                            dr. {{ $data['doctor']->name }}
                        </span>
                        <small class="text-muted pull-right">Mengubah Jawaban</small>
                        <form id="answerForm" style="margin-top: 20px;" action="{{ route('doctor.thread.edit.submit', ['id' => $data['thread']->id])  }}" method="POST">
                            @csrf
                            <label for="ckmini1" class="sr-only">Jawaban</label>
                            <textarea id="ckmini1" name="answer">{{ $data['thread']->answer }}</textarea>
                            <div class="box-footer text-right" style="background-color: transparent;">
                                <input type="hidden" name="_method" value="PUT">

                                @if ($errors->has('answer'))
                                    <span class="text-danger" role="alert" style="margin-right: 10px;">
                                        <strong>{{ $errors->first('answer') }}</strong>
                                    </span>
                                @endif

                                <button type="submit" class="btn btn-success btn-sm"><strong>Kirim Perubahan</strong></button>
                                <button type="reset" class="btn btn-danger btn-sm" onclick="CKEDITOR.instances.ckmini1.setData('{{ $data['thread']->answer }}', function() { this.updateElement(); } )"><strong>Reset</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
