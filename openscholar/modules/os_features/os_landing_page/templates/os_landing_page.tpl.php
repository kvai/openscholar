<?php
/**
 * @Name: os_landing_page.tpl.php
 * @created: 21/05/2018
 * @Author:
 * @Version: 1.0
 **/
?>
<div id="landing-page-content-wrapper">
  <!-- menu bar -->
  <div class="logo-menu-bar-wrapper row">
    <div class="logo">
      <a href="<?php echo $variables['schoolDetails']['path_to_school_main_website']; ?>">
      <img src="<?php echo $variables['schoolDetails']['path_to_logo']; ?>"></a>
    </div>
    <div class="menu">
      <ul>
        <li><a href="link">Contact Support</a></li>
        <li><a href="https://help.theopenscholar.com/" target="_blank">Documentation</a></li>
        <li><a href="https://help.theopenscholar.com/video-tutorials" target="_blank">Video Tutorials</a></li>
        <li><a href="/user" class="log-in">Log In</a></li>
      </ul>
    </div>
  </div>
  <!-- region content top -->
  <div class="hero">
  	<div class="svg-wrapper">
  	<svg width="1025px" height="537px" viewBox="0 0 1025 537" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Artboard" fill="<?php echo $variables['schoolDetails']['school_primary_color']; ?>">
            <g id="bg-6a" transform="translate(-3.007812, 0.000000)">
                <path d="M967.385828,290.9 C889.220311,339.7 813.563315,375.1 742.321316,398.2 C677.601472,419.2 615.590831,430.2 558.095528,432.4 C454.644118,436.4 362.029519,409.5 286.974568,368.2 C221.953702,332.4 158.337607,313.7 104.655256,322.6 C63.415169,329.6 26.891102,352.5 0.501460103,384 L0.501460103,484 C3.21066288,484.2 5.81952481,482.6 8.12736421,479 C31.6071216,442.8 69.5359605,416.4 112.682523,411.3 C160.946469,405.6 217.538705,427.1 280.954118,458.3 C356.912136,495.8 449.225712,530.5 557.593823,535.5 C617.697989,538.2 683.120219,532.9 752.455742,518 C828.514101,501.6 910.392229,473.2 996.183651,431.3 C1009.02728,425 1020.76716,416.9 1031.10226,407.7 L1031.10226,271.1 C1012.43887,270.1 990.062859,276.8 967.385828,290.9 Z" id="Shape"></path>
                <rect id="Rectangle-path" x="0.501460103" y="0" width="1032.20548" height="407.6"></rect>
                <path d="M416.211886,425 C442.588687,424.2 468.965488,423.5 495.34229,422.7 C494.640246,417.8 494.038494,412.9 493.336449,408 C473.779505,412.9 453.721101,407.1 434.665617,402.7 C414.607213,398.1 393.445597,394.2 373.487485,401.3 C365.263539,404.2 366.968503,415.3 375.493325,416 C390.737712,417.3 405.9821,418.7 421.126195,420 C421.126195,415 421.126195,410 421.126195,405 C408.790276,405.4 396.354066,405.8 384.018147,406.2 C374.289821,406.5 374.390113,420.6 384.018147,421.2 C403.775675,422.5 423.533203,423.8 443.290731,425 C443.290731,420 443.290731,415 443.290731,410 C440.582847,410.2 437.975254,410.5 435.26737,410.7 C425.739628,411.5 425.438752,425.8 435.26737,425.7 C466.859356,425.3 498.250758,422.7 529.541869,418 C537.966399,416.7 535.960558,402.7 527.536029,403.3 C514.798942,404.2 502.162147,405.1 489.425061,405.9 C479.797027,406.6 479.596443,420.7 489.425061,420.9 C524.527268,421.8 559.629475,421.3 594.731682,419.5 C604.5603,419 604.259424,405.5 594.731682,404.5 C564.744368,401.3 534.656762,399.1 504.468864,398.1 C496.144626,397.8 494.038494,411.6 502.463023,412.8 C527.736613,416.4 553.210786,418.8 578.684959,419.8 C588.513577,420.2 588.212701,405.7 578.684959,404.8 C530.945957,400.4 483.106663,397.8 435.26737,397 C425.438752,396.8 425.739628,411.3 435.26737,412 C476.286806,415.1 517.506826,417.4 558.626555,418.8 C558.626555,413.8 558.626555,408.8 558.626555,403.8 C539.270195,404 519.913835,404.3 500.457183,404.5 C500.457183,409.5 500.457183,414.5 500.457183,419.5 C572.968314,417.7 645.479445,415.9 717.890284,414.1 C717.18824,409.2 716.586487,404.3 715.884443,399.4 C700.84064,401.9 685.796837,404.4 670.753034,406.9 C662.328504,408.3 664.434637,422 672.758874,421.6 C688.805598,421 704.852321,420.3 720.999336,419.7 C730.727662,419.3 730.62737,405.2 720.999336,404.7 C665.537849,402 610.076361,401.2 554.514582,402.4 C544.786256,402.6 544.886548,416.9 554.514582,417.4 C588.112409,419.3 621.609944,421.2 655.207771,423.1 C655.207771,418.1 655.207771,413.1 655.207771,408.1 C602.253584,412.5 549.199105,416.9 496.244918,421.4 C488.321848,422.1 485.313088,434.6 494.239078,436.1 C543.98392,444.6 594.531098,443.5 644.777401,442.1 C654.606019,441.8 654.405435,427.8 644.777401,427.1 C608.672273,424.6 572.567146,423.8 536.462018,425 C526.733692,425.3 526.833984,439.4 536.462018,440 C576.979995,442.3 617.397679,438.5 657.715071,434.7 C667.242813,433.8 667.543689,420.2 657.715071,419.7 C621.008192,417.7 584.20102,417.6 547.494141,419.1 C537.866107,419.5 537.765815,434.2 547.494141,434.1 C606.465849,433.3 665.236973,427.6 724.008097,421.9 C733.535839,421 733.836715,407 724.008097,406.9 C696.929251,406.6 669.850406,407.3 642.77156,409 C634.547615,409.5 632.240898,421.6 640.76572,423.7 C643.072436,424.3 645.379153,424.9 647.685869,425.4 C647.685869,420.6 647.685869,415.8 647.685869,410.9 C587.510657,424.5 525.329604,427.5 464.151471,420.3 C465.455268,425 466.658772,429.6 467.962568,434.3 C474.280966,430.8 481.000531,429.3 488.321848,429.4 C498.150466,429.5 497.84959,415.2 488.321848,414.4 C465.455268,412.5 442.388103,414.2 420.022982,419.3 C414.005461,420.7 412.300497,430.3 418.217726,433 C428.547804,437.7 439.479634,439.8 450.812633,438.5 C456.529278,437.8 461.945047,436.4 467.260524,434.1 C471.071621,432.4 472.074541,429.2 473.578921,425.7 C471.171913,427.5 468.764904,429.4 466.357896,431.2 C516.604198,431.6 566.750209,432 616.996511,432.5 C623.114324,432.6 627.527173,424 622.311988,419.7 C611.580742,410.8 599.645991,404.1 586.808613,398.7 C573.971234,393.2 560.532103,388.1 546.992681,384.7 C534.757054,381.6 521.418215,381.1 510.285801,387.9 C498.952803,394.7 494.439662,408 490.929441,420 C493.336449,418.2 495.743458,416.3 498.150466,414.5 C480.499071,414.4 463.148551,411.6 446.299492,406.3 C437.674378,403.6 433.963573,415.3 440.482555,420 C441.385183,420.6 442.187519,421.3 443.090147,421.9 C444.393943,417.2 445.597448,412.6 446.901244,407.9 C436.671458,408.6 426.441672,409.3 416.211886,410 C406.583852,410.6 406.48356,425.6 416.211886,425 C426.441672,424.3 436.671458,423.6 446.901244,422.9 C454.62373,422.4 456.830154,413.3 450.712341,408.9 C449.809713,408.3 449.007376,407.6 448.104748,407 C446.1992,411.6 444.193359,416.1 442.287811,420.7 C460.340375,426.4 479.195275,429.3 498.050174,429.4 C501.460103,429.4 504.368572,427.1 505.2712,423.9 C507.878792,415 510.686969,405.1 519.011207,400 C527.836905,394.7 539.972239,398.1 548.998521,400.8 C570.761889,407.3 593.929346,415.6 611.580742,430.2 C613.385998,425.9 615.090963,421.7 616.896219,417.4 C566.649917,417 516.503906,416.6 466.257604,416.1 C462.546799,416.1 460.340375,418.5 459.036578,421.6 C458.535118,422.7 458.13395,423.8 457.63249,424.9 C458.735702,423.4 459.939207,421.9 461.042419,420.4 C449.910005,425.3 436.671458,425.1 425.739628,420 C425.137875,424.6 424.536123,429.1 423.934371,433.7 C445.095988,429 466.658772,427.6 488.221556,429.4 C488.221556,424.4 488.221556,419.4 488.221556,414.4 C478.392938,414.3 468.965488,416.7 460.340375,421.4 C453.119349,425.3 457.331614,434.6 464.151471,435.4 C526.733692,442.8 590.218541,439.4 651.69755,425.5 C659.018868,423.9 658.818284,412.8 651.69755,411 C649.390834,410.4 647.084117,409.8 644.777401,409.3 C644.075356,414.2 643.473604,419.1 642.77156,424 C669.850406,422.3 696.929251,421.6 724.008097,421.9 C724.008097,416.9 724.008097,411.9 724.008097,406.9 C665.337265,412.6 606.566141,418.3 547.494141,419.1 C547.494141,424.1 547.494141,429.1 547.494141,434.1 C584.20102,432.5 621.008192,432.7 657.715071,434.7 C657.715071,429.7 657.715071,424.7 657.715071,419.7 C617.397679,423.6 576.979995,427.4 536.462018,425 C536.462018,430 536.462018,435 536.462018,440 C572.567146,438.9 608.772565,439.6 644.777401,442.1 C644.777401,437.1 644.777401,432.1 644.777401,427.1 C595.935187,428.5 546.591512,430 498.250758,421.7 C497.548714,426.6 496.946962,431.5 496.244918,436.4 C549.199105,432 602.253584,427.6 655.207771,423.1 C664.835805,422.3 664.936097,408.6 655.207771,408.1 C621.609944,406.2 588.112409,404.3 554.514582,402.4 C554.514582,407.4 554.514582,412.4 554.514582,417.4 C609.976069,416.2 665.537849,416.9 720.999336,419.7 C720.999336,414.7 720.999336,409.7 720.999336,404.7 C704.952613,405.3 688.90589,406 672.758874,406.6 C673.460919,411.5 674.062671,416.4 674.764715,421.3 C689.808518,418.8 704.852321,416.3 719.896124,413.8 C728.420946,412.4 726.214521,398.9 717.890284,399.1 C645.379153,400.9 572.868022,402.7 500.457183,404.5 C490.728857,404.7 490.728857,419.6 500.457183,419.5 C519.813543,419.3 539.169903,419 558.626555,418.8 C568.354881,418.7 568.254589,404.1 558.626555,403.8 C517.506826,402.4 476.387098,400.1 435.26737,397 C435.26737,402 435.26737,407 435.26737,412 C483.106663,412.8 530.945957,415.4 578.684959,419.8 C578.684959,414.8 578.684959,409.8 578.684959,404.8 C554.514582,403.8 530.444497,401.7 506.474704,398.3 C505.77266,403.2 505.170908,408.1 504.468864,413 C534.656762,414 564.744368,416.2 594.731682,419.4 C594.731682,414.4 594.731682,409.4 594.731682,404.4 C559.629475,406.2 524.527268,406.6 489.425061,405.8 C489.425061,410.8 489.425061,415.8 489.425061,420.8 C502.162147,419.9 514.798942,419 527.536029,418.2 C526.833984,413.3 526.232232,408.4 525.530188,403.5 C495.643166,408 465.455268,410.4 435.26737,410.7 C435.26737,415.7 435.26737,420.7 435.26737,425.7 C437.975254,425.5 440.582847,425.2 443.290731,425 C452.918765,424.1 453.019057,410.6 443.290731,410 C423.533203,408.7 403.775675,407.4 384.018147,406.2 C384.018147,411.2 384.018147,416.2 384.018147,421.2 C396.354066,420.8 408.790276,420.4 421.126195,420 C430.954813,419.7 430.653937,405.8 421.126195,405 C405.881807,403.7 390.63742,402.3 375.493325,401 C376.195369,405.9 376.797122,410.8 377.499166,415.7 C396.55465,409 416.312178,413.8 435.26737,418.2 C455.62665,422.9 476.587682,427.6 497.34813,422.4 C505.572076,420.3 503.867112,407.4 495.34229,407.7 C468.965488,408.5 442.588687,409.2 416.211886,410 C406.48356,410.2 406.48356,425.2 416.211886,425 Z" id="Shape" fill-rule="nonzero"></path>
            </g>
        </g>
    </g>
</svg>
</div>
    <div class="heading">
      <h1>Create and Manage Your Own Beautiful Website</h1>
      <h2>For labs, research centers, departments, schools, faculty and students</h2>
      <button>Get Started</button>
    </div>
    <div class="visual-image"><img src="/profiles/openscholar/modules/os_features/os_landing_page/includes/images/devices.png"></div>
  </div>
  
  <!-- region content first -->
  <div class="panel-first row">
  	<h2>Feature Highlights</h2>
    <div class="grid-wrapper">
    <div class="block-1 block">
    	<img src="/profiles/openscholar/modules/os_features/os_landing_page/includes/images/widgets-icon.png">
    	<h3 class="widgets">
	Widgets
</h3>
<span>Display snippets of larger pieces of content as:</span>

<ul><li>
		Lists
	</li>
	<li>
		Content sliders
	</li>
	<li>
		Other media such as slideshows or videos
	</li>
</ul></div>
      <div class="block-2 block">
      	<img src="/profiles/openscholar/modules/os_features/os_landing_page/includes/images/themes-icon.png">
      	<h3 class="choose-theme">
	Many Theme Designs
</h3>

<ul><li>
		Select from a wide array of professional templates or create your own unique theme
	</li>
	<li>
		Templates to make construction simple while maintaining your individual style
	</li>
</ul></div>
      <div class="block-3 block">
      	<img src="/profiles/openscholar/modules/os_features/os_landing_page/includes/images/drag-drop-icon.png">
      	<h3 class="drag-drop">
	Drag and Drop Interface
</h3>
<span>The "drag-and-drop" tool allows you to:</span>

<ul><li>
		Easily arrange the content presentation on any site
	</li>
	<li>
		Design site-wide default layouts
	</li>
	<li>
		Create unique layouts for different sections of your site
	</li>
</ul></div>
      <div class="block-4 block">
      	<img src="/profiles/openscholar/modules/os_features/os_landing_page/includes/images/social-icon.png">
      	<h3 class="share-content">
	Share Content to Social Media
</h3>

<ul><li>
		Share&nbsp;your content on social networks such as Facebook and Twitter
	</li>
	<li>
		Extend the reach of your research, publications, speaking engagements, or departmental events
	</li>
</ul></div>
    </div>
  </div>
  <!-- region content second -->
  <div class="panel-second row">
    <div class="grid-wrapper">
      <h2>Easy-to-Use</h2>
      <div class="block-1 block"><p>Take a 1 1/2 minute tour to see what simple steps you will take to build a unique, professional-looking website on your own.</p>
<p>As soon as you know the basics, your content will shine online.</p> </div>
      <div class="block-2 block"><iframe width="476" src="https://www.youtube.com/embed/WadTyp3FcgU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
     
    </div>
  </div>
  <!-- region branding footer -->
 
    <div class="branding_footer row">
      <div class="branding-container">
        <div class="copyright">
          <span class="copyright">Copyright &copy; <?php echo date('Y'); ?> <?php echo $variables['schoolDetails']['name_of_school']; ?></span>  | 
          <a href="<?php echo $variables['schoolDetails']['path_to_schools_accessibility_policy']; ?>">Accessibility</a> | 
          <a href="<?php echo $variables['schoolDetails']['path_to_schools_reporting_copyright_infringements']; ?>">Report Copyright Infringement</a></div>
      </div>
    </div>

</div>