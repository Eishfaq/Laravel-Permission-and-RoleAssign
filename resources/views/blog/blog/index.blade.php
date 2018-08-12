@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Blog</div>
                    <div class="card-body">
                        <a href="#" data-toggle="modal" data-target="#blog_add" class="btn btn-success btn-sm" title="Add New Blog">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/blog/blog', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table id="table-ajax" class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Title</th><th>Description</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($blog as $item)
                                    <tr>
                                    
                                        <td>{{ $item->title }}</td><td>{{ $item->description }}</td>
                                        <td>
                                            <a href="{{ url('/blog/blog/' . $item->id) }}" title="View Blog"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="#" class="edit_blog" data-editid="{{$item->id}}" data-toggle=modal data-target="#edit_data" title="Edit Blog"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/blog/blog', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Blog',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $blog->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal start -->
    <div id="blog_add" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add New Blog</h4>
          </div>
          <div class="modal-body">

            {!! Form::open(['id' =>'create_blog' ,'class' => 'form-horizontal', 'files' => true]) !!}

            @include ('blog.blog.form', ['formMode' => 'create'])

            {!! Form::close() !!}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <!-- modal end -->

    <!-- modal start Edit -->
      <div class="modal" tabindex="-1" role="dialog" style="display:none;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div id="modal-hold" class="modal-body">
                
                 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- modal end Edit-->

    <script type="text/javascript">
        $(document).ready(function(){
            $('#create_blog').submit(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                  url: "{{ url('blog/blog') }}",
                  method: 'post',
                  dataType: 'json',
                  data: {
                    title: $('#title').val(),
                    description: $('#description').val()
                  },
                  success: function(result){
                     $('#table-ajax tr:first').after(
                            "<tr><td>"+ result.title+"</td><td>"+ result.description +"</td><td><a href='{{ url('/blog/blog/' . $item->id) }}' title=''><button class='btn btn-info btn-sm'><i class='fa fa-eye' aria-hidden='true'></i> View</button></a><a href='#' class='edit_blog' data-editid='"+result.id+"' data-toggle='modal' data-target='#edit_data' title='Edit Blog'><button class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button></a></td><td></td></tr>"
                        );
                }});
            });
            //edit data
            $('.edit_blog').click(function(e){
                e.preventDefault();
                // alert($(this).data('editid'));
                $.ajax({
                    url : "{{url('blog/blog')}}"+ "/" + $(this).data('editid') + "/edit",
                    type       :'GET',
                    dataType: "json",
                    success: function(response){
                        $('.modal').show();
                        var output = "<form method='POST' action='";
                        output += "{{ url('blog/blog') }}" + "/" + response.id;
                        output += "'>";
                        output += "<h1>asdasa</h1>";
                        output += "</form>";
                        document.getElementById('modal-hold').innerHTML = output;
                    }
                });
            });
        });
    </script>
@endsection
