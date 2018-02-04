<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body >
<div id="app">
    @include('components/nav')
    <div class="container">
        <form>

            <div class="form-group">
                <label for="source">From:</label>
                <select class="form-control" id="source" v-model="source">
                    @foreach($stations as $station)
                        <option value="{{$station->id}}"> {{$station->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="destination">To</label>
                <select class="form-control" id="destination" v-model="destination">

                    @foreach($stations as $station)
                        <option value="{{$station->id}}"> {{$station->name}}</option>
                    @endforeach
                </select>
            </div>





            <button @click="getShortestPath"  type='button' class="btn btn-primary">Submit</button>
        </form>
        <div class="station text-center">
            <h4 v-for="station in stations">@{{  station}} </h4>

        </div>
    </div>


</div>


<script src="js/app.js"> </script>
<script>
    const app = new Vue({
        el: '#app',
        data : {
            source : 1,
            destination : 1,
            stations : []
        },
        methods : {
            getShortestPath(){
                axios.post('/shortestPath',{
                   src : this.source,
                    dest : this.destination
                })
                    .then(function(response){
                        this.stations = [];
                       response.data.forEach(function(item){
                           this.stations.push(item);

                       }.bind(this));
                }.bind(this)).
            catch(function(error){
                console.log(error);
                })

            }
        }
    });

</script>
</body>
</html>