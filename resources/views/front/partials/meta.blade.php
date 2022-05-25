<meta charset="utf-8" lang="id">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>{{ !empty($title) ? $title : null }}</title>
<meta name="author" content="SeCan Id">
<meta name="keywords" content="{{ !empty($keyword) ? $keyword : null }}">
<meta name="description" content="{{ !empty($description) ? $description : null }}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

@stack('metas')
