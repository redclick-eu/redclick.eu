{{--
  Category Template: Portfolio
--}}

@include("components.breadcrumbs")
@include("components.title", ["text" => wpcl_t("Portfolio")])
@include("blocks.portfolio")
@include('blocks.callback')
