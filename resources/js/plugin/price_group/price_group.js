/**
 * Created by yyc on 2016/9/8.
 */
function PriceGroup (el, opts) {
    var me = this;
    opts.name1 = opts.name1 || 'price_group_input_1';
    opts.name2 = opts.name2 || 'price_group_input_2';

    var eventMap = {};

    this.on = function (eventName, callback) {
        eventMap[eventName] = eventMap[eventName] || [];
        eventMap[eventName].push(callback);
    };

    this.fire = function (eventName, params) {
        var i, len;
        if (eventMap[eventName]) {
            for (i=0, len=eventMap[eventName].length; i<len; i++) {
                eventMap[eventName][i](params);
            }
        }
    };
    this.un = function (eventName, callback) {
        var i, len;
        if (eventMap[eventName]) {
            for (i=0, len=eventMap[eventName].length; i<len; i++) {
                if (eventMap[eventName] === callback) {
                    eventMap[eventName].splice(i, 1);
                    break;
                }
            }
        }
    };

    var html = [
        '<div class="btn_group_hide" price-group>',
        '    <div class="price_input clearfix">',
        '        <div class="unit_input fl">',
        '            <div class="fl">￥</div>',
        '            <input type="text" name="' + opts.name1 + '">',
        '        </div>',
        '        <i class="fl"></i>',
        '        <div class="unit_input fl">',
        '            <div class="fl">￥</div>',
        '            <input type="text" name="' + opts.name2 + '">',
        '        </div>',
        '    </div>',
        '    <div class="price_btn">',
        '        <span class="clear_price">清空价格</span>',
        '        <span class="confirm_btn">确定</span>',
        '    </div>',
        '</div>'
    ].join('');

    var group = $(html), inputs = group.find('.unit_input input'), clearBtn = group.find('.clear_price'), confirmBtn = group.find('.confirm_btn');

    me.on('action', function () {
        group.removeClass('btn_group_hide');
    });
    me.on('clear', function () {
        inputs.val('');
    });
    me.on('confirm', function () {
        group.addClass('btn_group_hide');
    });


    inputs.on('focus', function (e) {
        me.fire('action');
    });
    inputs.on('keyup', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    inputs.on('change', function (e) { // 防止右键粘贴
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    clearBtn.on('click', function (e) {
        me.fire('clear');
    });
    confirmBtn.on('click', function (e) {
        me.fire('confirm', [inputs.eq(0).val(), inputs.eq(1).val()]);
    });

    el.append(group);
}