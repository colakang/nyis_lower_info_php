/**
 * Created by Shaochen on 7/11/2016.
 */
$(document).ready(function () {
  $(".input-for-datalist").val("name");
  $('.search-choices li a').click(function () {
    $(".btn-choice .choices").text($(this).text());
    $(".search-input-choice").attr("placeholder", $(this).text());
    if ($(this).text() == "律师姓名") {
      $(".input-for-datalist").val('name');
    }
    else {
      $(".input-for-datalist").val('practice_area');
    }
  });
});

(function () {
  var substringMatcher = function (strs) {
    return function findMatches(q, cb) {
      var matches, substringRegex;

      // an array that will be populated with substring matches
      matches = [];

      // regex used to determine if a string contains the substring `q`
      substrRegex = new RegExp(q, 'i');

      // iterate through the pool of strings and for any string that
      // contains the substring `q`, add it to the `matches` array
      $.each(strs, function(i, str) {
        if (substrRegex.test(str)) {
          matches.push(str);
        }
      });

      cb(matches);
    };
  };
  var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
    'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
    'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
    'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
    'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
    'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
  ];
  $('#the-basics .typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: 'states',
      source: substringMatcher(states)
    });
})();

$(function () {
    $("#rateYo").rateYo({
      starWidth: "16px",
      halfStar: true,
      onInit: function(rating){
        $('#rating_score').val(rating);
      }
    }).on('rateyo.change', function (e, data) {
      $('#rating_score').val(data.rating);
    });
  });
