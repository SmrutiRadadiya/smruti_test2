<?php
    $email = Session::get('email');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Application</title>
    <link rel="stylesheet" href="{{ URL::asset('css/app_assets/bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Add Poppins Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        
    <!-- Add Styling -->
    <style>
    body {
        padding-top: 20px;
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    .card {
        margin-bottom: 20px;
    }

    .modal-content {
        border-radius: 0.5rem;
    }
    </style>
</head>

<body>

    <div class="container">
        <!-- Navigation Buttons -->
        <div class="mb-4">
            @if(!$email)
            <a href="/login" class="btn btn-primary me-2">Login</a>
            <a href="/register" class="btn btn-secondary">Register</a>
            @else
            <form action="logout" method="post" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger me-2">Logout</button>
            </form>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_blog">
                Add Blog
            </button>
            @endif
        </div>

        <!-- Add Blog Modal -->
        <div class="modal fade" id="add_blog" tabindex="-1" aria-labelledby="addBlogLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBlogLabel">Add Blog</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/add_blogs" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Enter title" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" name="content" id="content" placeholder="Enter content"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Blog</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Cards -->
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$blog->title}}</h5>
                        <p class="card-text">{{$blog->content}}</p>
                        <p class="card-text"><small class="text-muted">Created: {{$blog->created_at}}</small></p>
                        <p class="card-text"><small class="text-muted"> last Updated: {{$blog->updated_at}}</small></p>
                        @if($email)
                        <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal"
                            data-bs-target="#edit_blog_{{$blog->id}}">
                            Edit
                        </button>
                        <!-- Edit Blog Modal -->
                        <div class="modal fade" id="edit_blog_{{$blog->id}}" tabindex="-1"
                            aria-labelledby="editBlogLabel_{{$blog->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editBlogLabel_{{$blog->id}}">Edit Blog</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/edit_blogs" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$blog->id}}">
                                            <div class="mb-3">
                                                <label for="edit_title_{{$blog->id}}" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    id="edit_title_{{$blog->id}}" value="{{$blog->title}}"
                                                    placeholder="Update title" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_content_{{$blog->id}}"
                                                    class="form-label">Content</label>
                                                <textarea class="form-control" name="content"
                                                    id="edit_content_{{$blog->id}}" placeholder="Update content"
                                                    required>{{$blog->content}}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="delete_blogs" method="post" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{$blog->id}}">
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this blog?');">Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>