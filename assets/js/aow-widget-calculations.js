// assets/js/ops-widget-calculations.js
jQuery(document).ready(function ($) {
    // Your calculation logic here
    $("select[id='academic-level'], select[id='subject'], select[id='paper-type'], select[id='urgency'], select[id='pages']").change(function(){

        let academicLevelNode = $("select[id='academic-level']");
        let subjectNode = $("select[id='subject']");
        let paperTypeNode = $("select[id='paper-type']");
        let urgencyNode = $("select[id='urgency']");
        let pagesNode = $("select[id='pages']");

        let pages = parseFloat(pagesNode.val(), 1);
        let urgency = parseFloat(urgencyNode.val(), 1);
        let subject = parseFloat(subjectNode.val(), 1);
        let academicLevel = parseFloat(academicLevelNode.val(), 1);
        // let paperType = parseFloat(paperTypeNode.val(), 1);

        let total = urgency*pages*academicLevel*subject;
        let fixedTotal = total.toFixed(2);

        // $(".aow-total").val((((100)/100*urgency)*(pages*academic*pptype*subject)).toFixed(2));
        if (!isNaN(fixedTotal))
            $(".aow-total").html('$' + fixedTotal);
        else
            $(".aow-total").html('$0.00');
    });
});
