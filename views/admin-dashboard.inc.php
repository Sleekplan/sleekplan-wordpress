<?php 
    // load required data
    $stats = load_stats(); 
?>
<div class='wrap sp-admin dashboard'>

    <h1>
        Sleekplan 
        <span><?php _e( 'Dashbaord', 'sleekplan-wp' ); ?></span>
    </h1>

    <a href="https://app.sleekplan.com/?pid=<?php echo $data['product']; ?>" target="_blank" style="position: absolute;top: 15px;right: 0px;display: flex;align-items: center;justify-content: center;line-height: 40px;border: 1px solid #0071a1;text-align: center;color: #0071a1;font-weight: 600;border-radius: 5px;width: 250px;cursor: pointer;text-decoration:none;">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="width: 25px;height: 25px;margin-left: 10px;flex-basis: 25px;" viewBox="0 0 480 480" version="1.1"><desc/><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="logo" transform="translate(-1.000000, -1.000000)" fill="#00b3a4" fill-rule="nonzero"><path d="M460.9,175 C510.4,340 472,411.4 307,460.9 C142,510.4 70.6,472 21.1,307 C-28.4,142 10,70.6 175,21.1 C340,-28.4 411.4,10 460.9,175 Z M204.681869,115.09121 C178.057475,123.231104 178.057475,123.231104 159.972736,138.89773 C141.887997,154.564355 141.887997,154.564355 134.993772,174.737793 C128.099548,194.911231 128.099548,194.911231 134.977426,216.982648 C143.107477,243.999957 143.107477,243.999957 165.805713,254.476228 C188.149289,264.788807 188.149289,264.788807 220.546727,263.085943 L221.57775,263.028857 L250.118258,261.5814 C264.411603,260.720643 264.411603,260.720643 274.822349,261.826729 C285.233094,262.932815 285.233094,262.932815 291.754804,267.047461 C298.276514,271.162108 298.276514,271.162108 300.783892,279.363372 C303.472964,288.15893 303.472964,288.15893 300.195626,296.569134 C296.918288,304.979338 296.918288,304.979338 288.394129,311.744436 C279.869971,318.509534 279.869971,318.509534 266.795492,322.506804 C253.483295,326.576751 253.483295,326.576751 241.710593,325.692104 C229.937891,324.807456 229.937891,324.807456 221.20859,318.573409 C212.709008,312.503416 212.709008,312.503416 208.148041,300.978235 L207.904379,300.351267 L158.1025,315.57723 C166.727672,341.663353 166.727672,341.663353 184.343362,355.70803 C201.959052,369.752708 201.959052,369.752708 226.53141,372.117812 C251.103768,374.482916 251.103768,374.482916 280.580775,365.470891 C310.2955,356.386187 310.2955,356.386187 328.649375,340.962201 C347.003249,325.538215 347.003249,325.538215 353.238829,305.761098 C359.474408,285.983982 359.474408,285.983982 352.76157,263.602169 C347.991343,248.424569 347.991343,248.424569 338.985721,238.310954 C329.980098,228.197339 329.980098,228.197339 317.580935,222.500421 C305.181772,216.803504 305.181772,216.803504 290.052635,214.930506 C275.505387,213.129547 275.505387,213.129547 259.212467,214.265562 L257.90624,214.361142 L234.437294,215.817692 C225.928666,216.469509 225.928666,216.469509 218.134706,216.058033 C210.340747,215.646556 210.340747,215.646556 203.920101,213.775465 C197.499456,211.904374 197.499456,211.904374 192.978662,207.957799 C188.457869,204.011224 188.457869,204.011224 186.696952,197.401307 C184.29859,189.556619 184.29859,189.556619 186.98504,181.976912 C189.671489,174.397205 189.671489,174.397205 197.276194,168.238134 C204.880899,162.079063 204.880899,162.079063 217.479942,158.227149 C236.021931,152.558294 236.021931,152.558294 249.272791,157.215009 C262.282727,161.787055 262.282727,161.787055 268.132743,175.313533 L268.346955,175.817584 L317.673399,160.736977 C310.666819,139.094815 310.666819,139.094815 294.324129,126.025615 C277.981438,112.956415 277.981438,112.956415 254.881568,109.881188 C231.781698,106.805961 231.781698,106.805961 204.681869,115.09121 Z" id="Combined-Shape"/></g></g></svg>
        <span style="display: block;flex-basis: calc(100%);margin-left: -12.5px;"><?php _e('Visit Sleekplan dashbaord', 'sleekplan-wp'); ?></span>
    </a>

    <div style="margin-top: 50px;">

        <h2><?php _e('Community stats', 'sleekplan-wp'); ?></h2>

        <div style="display: flex;width: 100%;display: flex;background: #FFFFFF;padding: 30px 0px;border: 1px solid #eee;border-radius: 8px;">
            <div style="flex: 1;border-right: 1px solid #eee;padding: 20px;">
                <svg xmlns='http://www.w3.org/2000/svg' style="width: 30px;height: 30px;display: block;margin: 0 auto;opacity: .1;margin-bottom: 20px;" viewBox='0 0 512 512'><title>ionicons-v5-h</title><path d='M304,384V360c0-29,31.54-56.43,52-76,28.84-27.57,44-64.61,44-108,0-80-63.73-144-144-144A143.6,143.6,0,0,0,112,176c0,41.84,15.81,81.39,44,108,20.35,19.21,52,46.7,52,76v24' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='224' y1='480' x2='288' y2='480' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='208' y1='432' x2='304' y2='432' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><line x1='256' y1='384' x2='256' y2='256' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/><path d='M294,240s-21.51,16-38,16-38-16-38-16' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg>
                <span style="display: block;text-align: center;font-size: 30px;line-height: 1;font-weight: 700;"><?php echo $stats['general']['general']['total_items']; ?></span>
                <span style="display: block;text-align: center;font-size: 15px;line-height: 1;font-weight: 200;margin-top: 5px;"><?php _e('Feedback items', 'sleekplan-wp'); ?></span>
            </div>
            <div style="flex: 1;border-right: 1px solid #eee;padding: 20px;">
                <svg xmlns='http://www.w3.org/2000/svg' style="width: 30px;height: 30px;display: block;margin: 0 auto;opacity: .1;margin-bottom: 20px;" viewBox='0 0 512 512'><title>ionicons-v5-b</title><path d='M342.43,273.77,268.3,184.68a16,16,0,0,0-24.6,0l-74.13,89.09A16,16,0,0,0,181.86,300H330.14A16,16,0,0,0,342.43,273.77Z'/><path d='M448,256c0-106-86-192-192-192S64,150,64,256s86,192,192,192S448,362,448,256Z' style='fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:32px'/></svg>
                <span style="display: block;text-align: center;font-size: 30px;line-height: 1;font-weight: 700;"><?php echo $stats['general']['general']['total_comments']; ?></span>
                <span style="display: block;text-align: center;font-size: 15px;line-height: 1;font-weight: 200;margin-top: 5px;"><?php _e('Comments', 'sleekplan-wp'); ?></span>
            </div>
            <div style="flex: 1;border-right: 1px solid #eee;padding: 20px;">
                <svg xmlns='http://www.w3.org/2000/svg' style="width: 30px;height: 30px;display: block;margin: 0 auto;opacity: .1;margin-bottom: 20px;" viewBox='0 0 512 512'><title>ionicons-v5-l</title><path d='M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path d='M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11' style='fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg>
                <span style="display: block;text-align: center;font-size: 30px;line-height: 1;font-weight: 700;"><?php echo $stats['general']['general']['total_votes']; ?></span>
                <span style="display: block;text-align: center;font-size: 15px;line-height: 1;font-weight: 200;margin-top: 5px;"><?php _e('Votes', 'sleekplan-wp'); ?></span>
            </div>
            <div style="flex: 1;border-right: 1px solid #eee;padding: 20px;">
                <svg xmlns='http://www.w3.org/2000/svg' style="width: 30px;height: 30px;display: block;margin: 0 auto;opacity: .1;margin-bottom: 20px;" viewBox='0 0 512 512'><title>ionicons-v5-j</title><path d='M258.9,48C141.92,46.42,46.42,141.92,48,258.9,49.56,371.09,140.91,462.44,253.1,464c117,1.6,212.48-93.9,210.88-210.88C462.44,140.91,371.09,49.56,258.9,48ZM385.32,375.25a4,4,0,0,1-6.14-.32,124.27,124.27,0,0,0-32.35-29.59C321.37,329,289.11,320,256,320s-65.37,9-90.83,25.34a124.24,124.24,0,0,0-32.35,29.58,4,4,0,0,1-6.14.32A175.32,175.32,0,0,1,80,259C78.37,161.69,158.22,80.24,255.57,80S432,158.81,432,256A175.32,175.32,0,0,1,385.32,375.25Z'/><path d='M256,144c-19.72,0-37.55,7.39-50.22,20.82s-19,32-17.57,51.93C191.11,256,221.52,288,256,288s64.83-32,67.79-71.24c1.48-19.74-4.8-38.14-17.68-51.82C293.39,151.44,275.59,144,256,144Z'/></svg>
                <span style="display: block;text-align: center;font-size: 30px;line-height: 1;font-weight: 700;"><?php echo $stats['product']['product_mau']; ?></span>
                <span style="display: block;text-align: center;font-size: 15px;line-height: 1;font-weight: 200;margin-top: 5px;"><?php _e('Tracked user', 'sleekplan-wp'); ?><span style="display:block;font-size: 10px;">(last 30 days)</span></span>
            </div>
        </div>

    </div>

    <div style="margin-top: 50px;">

        <h2><?php _e('Customer satisfaction', 'sleekplan-wp'); ?></h2>

        <div style="background: #FFFFFF;padding: 30px 0px;border: 1px solid #eee;border-radius: 8px;">
            <div style="position:relative;margin:10px 20px; margin-bottom:-10px;">
                <canvas id="csatisfaction" height="250"></canvas>
            </div>
        </div>

    </div>

    <div style="margin-top: 50px;">

        <h2><?php _e('Trending feedback', 'sleekplan-wp'); ?></h2>

        <div style="background: #FFFFFF;padding: 30px 0px;border: 1px solid #eee;border-radius: 8px;">
            
            <div style="margin:-30px 0;">

                <?php if( count( $stats['feedback']['items'] ) == 0 ) : ?>

                    <span>No results...</span>

                <?php else : ?>

                    <?php foreach( $stats['feedback']['items'] as $feedback_item ) : ?>
                    <a href="https://app.sleekplan.com/feedback/<?php echo $feedback_item['feedback_id']; ?>?pid=<?php echo $data['product']; ?>" target="_blank" style="color: #000;text-decoration: none;font-size: 15px;font-weight: 500;">
                        <div style="height: 50px;display: flex;align-items: center;padding: 10px 30px;border-bottom: 1px solid #eee;">
                            <img style="border-radius: 50%;height: 30px;width: 30px;" src="<?php echo $feedback_item['user']['data_img']; ?>">
                            <div style="margin-left: 10px;max-width: 500px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                                <?php echo $feedback_item['title']; ?>
                            </div>
                            <div style="margin-left: auto;font-size: 11px;">
                                <?php if( $feedback_item['total_comments'] ) : ?>
                                <span style="width: 60px;display: inline-block;text-align: center;line-height: 20px;border-radius: 15px;margin-left:10px;font-weight: 300;border:1px solid #0071a1; color: #0071a1;">
                                    <svg xmlns='http://www.w3.org/2000/svg' style="height: 10px;width: 10px;fill:#0071a1;" viewBox='0 0 512 512'><title>ionicons-v5-l</title><path d='M60.44,389.17c0,.07,0,.2-.08.38C60.39,389.43,60.41,389.3,60.44,389.17Z'/><path d='M439.9,405.6a26.77,26.77,0,0,1-9.59-2l-56.78-20.13-.42-.17a9.88,9.88,0,0,0-3.91-.76,10.32,10.32,0,0,0-3.62.66c-1.38.52-13.81,5.19-26.85,8.77-7.07,1.94-31.68,8.27-51.43,8.27-50.48,0-97.68-19.4-132.89-54.63A183.38,183.38,0,0,1,100.3,215.1a175.9,175.9,0,0,1,4.06-37.58c8.79-40.62,32.07-77.57,65.55-104A194.76,194.76,0,0,1,290.3,32c52.21,0,100.86,20,137,56.18,34.16,34.27,52.88,79.33,52.73,126.87a177.86,177.86,0,0,1-30.3,99.15l-.19.28-.74,1c-.17.23-.34.45-.5.68l-.15.27a21.63,21.63,0,0,0-1.08,2.09l15.74,55.94a26.42,26.42,0,0,1,1.12,7.11A24,24,0,0,1,439.9,405.6Z'/><path d='M299.87,425.39a15.74,15.74,0,0,0-10.29-8.1c-5.78-1.53-12.52-1.27-17.67-1.65a201.78,201.78,0,0,1-128.82-58.75A199.21,199.21,0,0,1,86.4,244.16C85,234.42,85,232,85,232a16,16,0,0,0-28-10.58h0S49.12,230,45.4,238.61a162.09,162.09,0,0,0,11,150.06C59,393,59,395,58.42,399.5c-2.73,14.11-7.51,39-10,51.91a24,24,0,0,0,8,22.92l.46.39A24.34,24.34,0,0,0,72,480a23.42,23.42,0,0,0,9-1.79l53.51-20.65a8.05,8.05,0,0,1,5.72,0c21.07,7.84,43,12,63.78,12a176,176,0,0,0,74.91-16.66c5.46-2.56,14-5.34,19-11.12A15,15,0,0,0,299.87,425.39Z'/></svg>
                                    <?php echo $feedback_item['total_comments']; ?>
                                </span>
                                <?php endif; ?>
                                <span style="width: 100px;display: inline-block;text-align: center;background: #72777c;color: #fff;line-height: 20px;border-radius: 15px;margin-left:10px;font-weight: 300;background:<?php echo $stats['types'][$feedback_item['type']]; ?>">
                                    <?php echo $feedback_item['type']; ?>
                                </span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

        </div>
    </div>

</div>

<script>
// set satisfaction stats
var satisfaction = {
    data: JSON.parse('<?php echo json_encode( $stats['satisfaction']['data'] ); ?>'),
    labels: JSON.parse('<?php echo json_encode( $stats['satisfaction']['labels'] ); ?>')
};
</script>