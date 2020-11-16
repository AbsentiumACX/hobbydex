<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h3>{{ __('Pokedex') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach($pokedex->generations as $gen)
                    @if($gen === 1)
                        <a class="nav-item nav-link active" data-toggle="tab" href="#gen-{{ $gen }}" role="tab"
                           aria-controls="gen-{{ $gen }}" aria-selected="true">{{ __('Generation') }} {{ $gen }}</a>
                    @else
                        <a class="nav-item nav-link" data-toggle="tab" href="#gen-{{ $gen }}" role="tab"
                           aria-controls="gen-{{ $gen }}" aria-selected="true">{{ __('Generation') }} {{ $gen }}</a>
                    @endif
                @endforeach
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @foreach($pokedex->generations as $gen)
                @if($gen === 1)
                    <div class="tab-pane fade show active" id="gen-{{ $gen }}" role="tabpanel"
                         aria-labelledby="gen-{{ $gen }}-tab">
                        <div id="js_grid_{{ $gen }}"></div>
                        <script>
                            $("#js_grid_{{ $gen }}").jsGrid({
                                width: "100%",

                                inserting: false,
                                editing: false,
                                sorting: true,
                                paging: true,
                                autoload: true,

                                controller: {
                                    loadData: function () {
                                        var d = $.Deferred();

                                        $.ajax({
                                            url: "{{ route('api.pokemon.show', ['generation' => $gen]) }}",
                                            dataType: "json"
                                        }).done(function (response) {
                                            d.resolve(response['pokemons']);
                                        });

                                        return d.promise();
                                    }
                                },

                                fields: [
                                    {name: "id", type: "number", width: 50},
                                    {name: "name", type: "text", width: 150},
                                    {name: "generation", type: "number", width: 50},
                                    {name: "caught", type: "checkbox", width: 50}
                                ]
                            });
                        </script>
                    </div>
                @else
                    <div class="tab-pane fade" id="gen-{{ $gen }}" role="tabpanel" aria-labelledby="gen-{{ $gen }}-tab">
                        <div id="js_grid_{{ $gen }}"></div>
                        <script>
                            $("#js_grid_{{ $gen }}").jsGrid({
                                width: "100%",

                                inserting: false,
                                editing: false,
                                sorting: true,
                                paging: false,
                                autoload: true,

                                controller: {
                                    loadData: function () {
                                        var d = $.Deferred();

                                        $.ajax({
                                            url: "{{ route('api.pokemon.show', ['generation' => $gen]) }}",
                                            dataType: "json"
                                        }).done(function (response) {
                                            d.resolve(response['pokemons']);
                                        });

                                        return d.promise();
                                    }
                                },

                                fields: [
                                    {name: "id", type: "number", width: 50},
                                    {name: "name", type: "text", width: 150},
                                    {name: "generation", type: "number", width: 50},
                                    {name: "caught", type: "checkbox", id: "id", width: 50}
                                ]
                            });
                        </script>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="card-footer">

    </div>
</div>
