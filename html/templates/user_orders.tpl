<div class = 'container'>
    <p class = 'title'>Orders</p>

    <p class = 'small text-grey'><?=$greeting?></p>

    <div class = 'flex'>
        <?php for($i  = 0; $i < 3; $i++) {?>
        <div class = 'card flex'>
            <img class = 'buyer_pic'>
            <div>
                <div id = 'order-top-row' class = 'flex'>
                    <div>
                        <p class = 'order-title'>2828 S Avenida Santa Clara, Tucson AZ 85756</p>
                        <p class = 'date'>Next Wednesday</p>
                    </div>
                    <p class = 'order-fee'><?=$currency?>3912.12</p>
                </div>
                <div id = 'order-images' class = 'flex'>
                    <img/><img/><img/><img/>
                </div>
                <div class = 'text-right order-actions'>
                    <a>Deny</a>
                    <a class = 'approve'>Approve</a>
                </div>
            </div>
        </div><?php }?>
    </div>

    <div class = 'filter-tabs'>
        <a class = 'active'>All</a>
        <a>Pending <span class = 'count'>4</span></a>
        <a>In transit <span class = 'count'>1102</span></a>
        <a>Delayed</a>
        <a>Delivered<span class = 'count'>17</span></a>
        <a>Canceled<span class = 'count'>101</span></a>
    </div>
</div>

<div id = 'orders_table' >
    <input type = 'text' class = 'search' placeholder = 'Type to filter orders...'> <button id = 'filter'>Filter</button>
    <table>
        <thead>
            <tr>
                <th class = 'buyer'>Ordered By</th>
                <th class = 'addr'>Address</th>
                <th>Order ID</th>
                <th class = 'o-date'>Date</th>
                <th>Cost</th>
                <th>Status</th>
            </tr>
        </thead>
        
        <tbody>
            <?php for($i = 0; $i < 10; $i++) {?>
            <tr>
                <td>Tucson</td>
                <td>2828 S Avenida Santa Clara, Tucson AZ, 86756</td>
                <td>20zB10222</td>
                <td>Next Wednesday</td>
                <td><?=$currency?> 3812.12</td>
                <td><span class = 'status good'>Pending</span></td>
            </tr> <?php }?>
        </tbody>
    </table>
</div>