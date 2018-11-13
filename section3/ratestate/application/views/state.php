
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.2/p5.js"></script>


<div class="booth col-12">
    <h1><?=$state->state?></h1>
    <p><?=$this->input->get('msg')?></p>
    <form name="voting" id="voteform" method="post" action="http://www.rateastate.online/index.php/welcome/vote">

        <label class="lowrating">Garbage</label> <input name="rating" id='slider' type="range" min="1" max="10" step=".01" value="<?=round($state->rating)?>"> <label class="highrating">Lovely</label>
        <br><br>
        Average Rating: <?=$state->rating?>/10<br>
        Your Rating: <p id="val">???/10</p><br>


    Describe <b><?=$state->state?></b> in one word or phrase:<br>
        <input name='word' id="word_input">

    <input type="hidden" name="user_id" value="<?=$_COOKIE['ratestate_id']?>"><br>
        Your State: <br><select name="homestate">
            <?php if(isset($_COOKIE['ratestate_state_abbr'])):?>
            <option value="<?=$_COOKIE['ratestate_state_abbr']?>"><?=$_COOKIE['ratestate_state_abbr']?></option>
            <?php endif?>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District Of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
        </select>

        <input type="hidden" name="state_id" value="<?=$state->id?>">
    <input type="submit">
    </form>
</div>
<div id="canvasbox" class="col-6"></div>
<!--<div class="votes" style="max-height:130px;overflow-y:scroll;">-->
<!--    --><?php //foreach($votes as $vote):?>
<!--        --><?php //print_r($vote)?><!--<br>-->
<!--    --><?php //endforeach;?>
<!--</div>-->
<script>

    // this is the id of the form
    $("#voteform").submit(function(e) {


        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                window.location.href = 'http://www.rateastate.online/?state=<?=$state->abbr?>';
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });



    $('#slider').change(function(){
      $('#val').html($(this).val()+"/10");
    })

    //p5
    var words = <?=json_encode($cloud)?>;

    function setup() {

        var myCanvas = createCanvas(400, 250);
        myCanvas.parent("canvasbox");
        background(0);

        if(words.length ==0){

            fill(255);
            textSize(14);
            text("Nobody has submitted any words about this state yet.\n Why don't you be the first?", 50, 50)
        }
        for (let [key, value] of Object.entries(words)) {
            fill(random(50,255), random(50,255), random(50,255))
            textSize(value * 12)
            text(key, random(300), random(175))
        }
    }


</script>
