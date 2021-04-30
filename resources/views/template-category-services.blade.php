{{--
  Category Template: Services
--}}

@include("components.breadcrumbs", ["is_blue" => true])
@include("components.title", ["text" => wpcl_t("Services"), "is_blue" => true])
@include("blocks.services", ["is_blue" => true])
@include('blocks.callback')
