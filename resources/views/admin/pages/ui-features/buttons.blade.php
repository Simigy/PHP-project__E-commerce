@extends('admin.layouts.corona')

@section('title', 'Buttons - Admin Dashboard')

@section('content')
<div class="page-header">
    <h3 class="page-title">Buttons</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">UI Elements</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buttons</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Normal Buttons</h4>
                <p class="card-description">Add class <code>.btn-{color}</code> for buttons in theme colors</p>
                <div class="template-demo">
                    <button type="button" class="btn btn-primary">Primary</button>
                    <button type="button" class="btn btn-secondary">Secondary</button>
                    <button type="button" class="btn btn-success">Success</button>
                    <button type="button" class="btn btn-danger">Danger</button>
                    <button type="button" class="btn btn-warning">Warning</button>
                    <button type="button" class="btn btn-info">Info</button>
                    <button type="button" class="btn btn-light">Light</button>
                    <button type="button" class="btn btn-dark">Dark</button>
                    <button type="button" class="btn btn-link">Link</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Rounded Buttons</h4>
                <p class="card-description">Add class <code>.btn-rounded</code> for rounded buttons</p>
                <div class="template-demo">
                    <button type="button" class="btn btn-primary btn-rounded">Primary</button>
                    <button type="button" class="btn btn-secondary btn-rounded">Secondary</button>
                    <button type="button" class="btn btn-success btn-rounded">Success</button>
                    <button type="button" class="btn btn-danger btn-rounded">Danger</button>
                    <button type="button" class="btn btn-warning btn-rounded">Warning</button>
                    <button type="button" class="btn btn-info btn-rounded">Info</button>
                    <button type="button" class="btn btn-light btn-rounded">Light</button>
                    <button type="button" class="btn btn-dark btn-rounded">Dark</button>
                    <button type="button" class="btn btn-link btn-rounded">Link</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Outlined Buttons</h4>
                <p class="card-description">Add class <code>.btn-outline-{color}</code> for outline buttons</p>
                <div class="template-demo">
                    <button type="button" class="btn btn-outline-primary">Primary</button>
                    <button type="button" class="btn btn-outline-secondary">Secondary</button>
                    <button type="button" class="btn btn-outline-success">Success</button>
                    <button type="button" class="btn btn-outline-danger">Danger</button>
                    <button type="button" class="btn btn-outline-warning">Warning</button>
                    <button type="button" class="btn btn-outline-info">Info</button>
                    <button type="button" class="btn btn-outline-light">Light</button>
                    <button type="button" class="btn btn-outline-dark">Dark</button>
                    <button type="button" class="btn btn-link">Link</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Button Sizes</h4>
                <p class="card-description">Add class <code>.btn-{size}</code> for additional sizes</p>
                <div class="template-demo">
                    <button type="button" class="btn btn-outline-secondary btn-lg">Large</button>
                    <button type="button" class="btn btn-outline-secondary">Normal</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm">Small</button>
                </div>
                <div class="template-demo mt-4">
                    <button type="button" class="btn btn-danger btn-lg">Large</button>
                    <button type="button" class="btn btn-success">Normal</button>
                    <button type="button" class="btn btn-primary btn-sm">Small</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Button with Icons</h4>
                <p class="card-description">Add class <code>.btn-icon-text</code> and <code>&lt;i&gt;</code> for buttons with icon</p>
                <div class="template-demo">
                    <button type="button" class="btn btn-primary btn-icon-text">
                        <i class="mdi mdi-file-check btn-icon-prepend"></i>
                        Submit
                    </button>
                    <button type="button" class="btn btn-dark btn-icon-text">
                        Edit
                        <i class="mdi mdi-file-check btn-icon-append"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-icon-text">
                        <i class="mdi mdi-alert btn-icon-prepend"></i>
                        Warning
                    </button>
                </div>
                <div class="template-demo">
                    <button type="button" class="btn btn-danger btn-icon-text">
                        <i class="mdi mdi-upload btn-icon-prepend"></i>
                        Upload
                    </button>
                    <button type="button" class="btn btn-info btn-icon-text">
                        Print
                        <i class="mdi mdi-printer btn-icon-append"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-icon-text">
                        <i class="mdi mdi-reload btn-icon-prepend"></i>
                        Reset
                    </button>
                </div>
                <div class="template-demo mt-2">
                    <button type="button" class="btn btn-outline-primary btn-icon-text">
                        <i class="mdi mdi-file-check btn-icon-prepend"></i>
                        Submit
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-icon-text">
                        Edit
                        <i class="mdi mdi-file-check btn-icon-append"></i>
                    </button>
                    <button type="button" class="btn btn-outline-success btn-icon-text">
                        <i class="mdi mdi-alert btn-icon-prepend"></i>
                        Warning
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Block Buttons</h4>
                <p class="card-description">Add class <code>.btn-block</code> for block buttons</p>
                <div class="template-demo">
                    <button type="button" class="btn btn-info btn-lg btn-block">Block Button</button>
                    <button type="button" class="btn btn-primary btn-lg btn-block">Block Button</button>
                    <button type="button" class="btn btn-success btn-lg btn-block">Block Button</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 