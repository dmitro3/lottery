@for ($i=$from;$i<=$to;$i++)
    @php
        $name = $i<10?'0'.$i:''.$i;
    @endphp
    <label class="item_number" for="fromntom-{{$name}}">
        <span type="checkbox" id="fromntom-{{$name}}" name="number[]">{{$name}}</span>
    </label>
@endfor