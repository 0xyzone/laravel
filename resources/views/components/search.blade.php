<div class="relative w-full">
    <input type="search" name="search" id="search-{{$query}}" placeholder="🔍 Search orders by {{ $param }}" class="rounded-full w-full" autocomplete="off">
    <div class="absolute bg-white shadow-lg w-full z-[999] flex flex-col gap-2" id="result-{{$query}}">
    </div>
</div>
<script>
    $('#result-{{$query}}').hide();
    $('#search-{{$query}}').on('keyup', function() {
        $value = $(this).val();
        if ($value) {
            $('#result-{{$query}}').show();
        } else {
            $('#result-{{$query}}').hide();
        };
        $.ajax({
            type: 'get',
            url: '{{ URL::to('/search/' . $query . '') }}',
            data: {
                'search': $value
            },

            success: function(data) {
                $('#result-{{$query}}').html(data);
            }
        });
    })
</script>
