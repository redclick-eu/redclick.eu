@php
    $is_checked = isset($is_checked) && $is_checked ? 'checked' : '';
    $is_disabled = isset($is_disabled) && $is_disabled ? 'disabled' : '';
    $value = isset($value) ? 'value="' . $value . '"' : '';
    $id = isset($id) ? 'id="' . $id . '"' : '';

    $data_attributes_html = "";

    if(isset($data_attributes) && !empty($data_attributes)) {
        foreach ($data_attributes as $key => $val) {
            $data_attributes_html .= "data-$key='$val'";
        }
    }
@endphp

<label class="input input_checkbox">
    <input class="input-input"
           type="{!! $type ?? 'checkbox' !!}"
           name="{{ $name }}"
        {!! $is_checked !!}
        {!! $is_disabled !!}
        {!! $value !!}
        {!! $data_attributes_html !!}/>
    <span class="input-helper"></span>
    <span class="input-text">{!! $text ?? "" !!}</span>
</label>
