<div class="group_number">
    <div class="group">
       <label for="3cang-sl" class="xs">Chọn nhóm số</label>
       <button class="btn_xs">Chọn</button>
    </div>
    @for ($i=0;$i<$num;$i++)
        <select name="" id="bigntom-sl-{{$i}}">
            @for ($j = 0;$j<10;$j++)
                <option value="{{$j}}">{{$j}}</option>
            @endfor
        </select>
    @endfor
    
 </div>
 <div class="ls_number list_choosen">
    
 </div>