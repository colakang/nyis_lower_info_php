/*
 * Created by Shaochen on 7/14/2016.
 */
var reviewScore = 0;
var initRateYo = function(){
  $("#rateYo").rateYo({
    rating: 0,
    starWidth: "16px",
    halfStar: true
  }).on('rateyo.set', function (e, data) {
    reviewScore = data.rating;
  });
};

$('#submitReview').click(function () {
  $('#rateYo').rateYo('destroy');
  initRateYo();
});

$('#more-review').click(function(e){
  e.preventDefault();
});

initRateYo();

angular.
module('lawyerRate', []).
controller('reviewCtrl', ['$scope', function ($scope) {
  $scope.lawyerName = document.getElementById("lawyer_name").innerHTML;
  $scope.reviewlist = [];
  $scope.showNum = 5;
  /*var review = {
    score: 5,
    author: '小丸子',
    time: '07-21-2015',
    content: $scope.lawyerName + "律师帮我摆脱了不该发生问题与麻烦,她很关心客户,时刻工作。她就是这样一个友好,敬业,专业的律师。"
  };
  $scope.reviewlist.push(review);
  review = {
    score: 5,
    author: '花轮同学',
    time: '07-21-2015',
    content: "我和我的家人已经与他们一起工作了很长的时间和签证绿卡（永久居留）" +
    "取得了进展 - 全部在所允许的过程中最短的周转时间。更重要的是，" + $scope.lawyerName + "是专家，知道他们需要每一个人" +
    "的情况该怎么做。在我们的例子中，我们从来没有任何进一步的挫折或查询与已提交的任何申报。他们始终可用的网站，" +
    "回答任何问题，并就任何疑问或客户可能有所顾虑咨询。"
  };
  $scope.reviewlist.push(review);
  review = {
    score: 5,
    author: '梅子',
    time: '02-17-2015',
    content: $scope.lawyerName + "律师正在帮我们的转换H1状态。我们的情况下，有一个非常窄的时间框架，因为我们以前的状态到期。" +
    "幸运的是" + $scope.lawyerName + "律师正确处理我们的情况，所以我们提前得到了批准。令人惊喜的服务水平和质量，并且让我们实时更新" +
    "非常感激，那是很短的时间，我们真的很辛运找到他！谢谢"
  };
  $scope.reviewlist.push(review);*/
  $scope.getRange = function (start, end) {
    start = Math.ceil(start);
    end = Math.floor(end);
    var array = [];
    for(var i=start; i < end; i++){
      array.push(i);
    }
    return array;
  }
  $scope.isDecimal = function (num) {
    return num !== Math.round(num);
  };
  $scope.showMore = function(){
    $scope.showNum += 5;
  };
}]).
controller('writeReviewCtrl',['$scope', function ($scope) {
  $scope.addReview = function () {
    var date = new Date();
    var review = {};
    review.author = "anonymous";
    review.time = (date.getMonth() + 1).toString() + "-" + date.getDate().toString() + "-"
      + date.getFullYear().toString();
    review.score = reviewScore;
    review.content = $scope.content;
    $scope.reviewlist.splice(0, 0, review);
    $scope.content = "";
    reviewScore = 0;
  }
}]);
