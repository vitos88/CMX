<textarea id="tv{$tv->id}" name="tv{$tv->id}" class="cmx-tv" rows="10"
  data-cmx-language="{$cmx_language|default:'text/html'}"
  data-cmx-height="{$cmx_height|default:260}"
  style="width:100%;height:{$cmx_height|default:260}px">{$tv->value|escape}</textarea>
