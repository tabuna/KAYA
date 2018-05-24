@extends('platform::layouts.dashboard')

@section('title','title')
@section('description', 'description')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h1>Проекты</h1>
                        <a class="pull-right btn btn-default btn-sm" href="{{route('teams.create')}}">
                            <i class="fa fa-plus"></i> Создать проект
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teams as $team)
                                    <tr>
                                        <td>{{$team->name}}</td>
                                        <td>
                                            @if(auth()->user()->isOwnerOfTeam($team))
                                                <span class="label label-success">Владелец</span>
                                            @else
                                                <span class="label label-primary">Участник</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(is_null(auth()->user()->currentTeam) || auth()->user()->currentTeam->getKey() !== $team->getKey())
                                                <a href="{{route('teams.switch', $team)}}" class="btn btn-sm btn-default">
                                                    <i class="icon-logout"></i> Switch
                                                </a>
                                            @else
                                                <span class="label label-default">Текущая команда</span>
                                            @endif

                                            <a href="{{route('teams.members.show', $team)}}" class="btn btn-sm btn-default">
                                                <i class="icon-people"></i> Пользователи
                                            </a>

                                            @if(auth()->user()->isOwnerOfTeam($team))

                                                <a href="{{route('teams.edit', $team)}}" class="btn btn-sm btn-default">
                                                    <i class="icon-wrench"></i> Редактировать
                                                </a>

                                                <form style="display: inline-block;" action="{{route('teams.destroy', $team)}}" method="post">
                                                    {!! csrf_field() !!}
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm"><i class="icon-trash"></i> Удалить</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
