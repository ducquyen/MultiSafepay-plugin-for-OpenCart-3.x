{{ header }}{{ column_left }}
{{ header }}{{ column_left }}
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-multisafepay" data-toggle="tooltip" title="{{ button_save }}" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="{{ cancel }}" data-toggle="tooltip" title="{{ button_cancel }}" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
            <h1>{{ heading_title }}</h1>
            <ul class="breadcrumb">
                {% for breadcrumb in breadcrumbs %}
                <li><a href="{{ breadcrumb.href }}">{{ breadcrumb.text }}</a></li>
                {% endfor %}
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        {% if error_warning %}
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> {{ error_warning }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        {% endif %}
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> {{ text_edit }}</h3>
            </div>
            <div class="panel-body">
                <form action="{{ action }}" method="post" enctype="multipart/form-data" id="form-multisafepay" class="form-horizontal">
					 <ul class="nav nav-tabs" id="tabs">
                        <li class="active"><a href="#tab-default" data-toggle="tab">Default Store</a></li>
                        {% for store in stores %}
                        	<li><a href="#tab-store-{{ store.store_id }}" data-toggle="tab">Store {{ store.name }}</a></li>
                        {% endfor %}
                    </ul>

                    <div class="tab-content">
                    {% for store in stores %}
                    	<div class="tab-pane" id="tab-store-{{ store.store_id }}">

                            <div class="form-group">
                                {# -- Min amount -- #}
                                <label class="col-sm-2 control-label" for="minamount">{{ text_min_amount }}</label>
                                <div class="col-sm-10">
                                    {% set name  = 'payment_multisafepay_dirdeb_min_amount_'~store.store_id %}
                                    {% set value = attribute(_context, name) %}
                                    <input type="text" name= "{{ name }}" value= "{{ value }}"  id="minamount" class="form-control" />
                                </div>
                             </div>

                            <div class="form-group">
                                {# -- Max amount -- #}
                                <label class="col-sm-2 control-label" for="maxamount">{{ text_max_amount }}</label>
                                <div class="col-sm-10">
                                    {% set name  = 'payment_multisafepay_dirdeb_max_amount_'~store.store_id %}
                                    {% set value = attribute(_context, name) %}
                                    <input type="text" name= "{{ name }}" value= "{{ value }}"  id="maxamount" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                {# -- Geo-Zone -- #}
                                <label class="col-sm-2 control-label" for="input-msp-zone">{{ text_all_zones }}</label>
                                <div class="col-sm-10">
                                    {% set name  = 'payment_multisafepay_dirdeb_geo_zone_id_'~store.store_id %}
                                    {% set value = attribute(_context, name) %}

                                    <select name= "{{ name }}" id="input-geo-zone" class="form-control">
                                        <option value="0">{{ text_all_zones }}</option>
                                        {% for row in geo_zones %}
                                            <option value="{{ row.geo_zone_id }}" {% if value == row.geo_zone_id %}selected{% endif %}>{{ row.name }}</option>
                                        {% endfor %}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                {# -- Sorting -- #}
                                <label class="col-sm-2 control-label" for="input-sort-order">{{ entry_sort_order }}</label>
                                <div class="col-sm-10">
                                    {% set name  = 'payment_multisafepay_dirdeb_sort_order_'~store.store_id %}
                                    {% set value = attribute(_context, name) %}
                                    <input type="text" name= "{{ name }}" value= "{{ value }}"  id="input-sort-order" class="form-control" />
                                </div>
                            </div>

                        {% endfor %}
                    </div>



                    <div class="tab-pane active" id="tab-default">
                    <!--Module status-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status">{{ entry_status }}</label>
                        <div class="col-sm-10">
                            <select name="payment_multisafepay_dirdeb_status" id="input-status" class="form-control">
                                {% if payment_multisafepay_dirdeb_status %}
                                <option value="1" selected="selected">Enabled</option>
                                <option value="0">Disabled</option>
                                {% else %}
                                <option value="1">Enabled</option>
                                <option value="0" selected="selected">Disabled</option>
                                {% endif %}
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="minamount"><span>{{ text_min_amount }}</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="payment_multisafepay_dirdeb_min_amount" value="{{ payment_multisafepay_dirdeb_min_amount }}" id="minamount" class="form-control" />
                        </div>
                    </div>

                    <!--fco tax percentage-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="maxamount"><span>{{ text_max_amount }}</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="payment_multisafepay_dirdeb_max_amount" value="{{ payment_multisafepay_dirdeb_max_amount }}" id="maxamount" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-geo-zone">{{ text_all_zones }}</label>
                        <div class="col-sm-10">
                            <select name="payment_multisafepay_dirdeb_geo_zone_id" id="input-geo-zone" class="form-control">
                                <option value="0">{{ text_all_zones }}</option>
                                {% for geo_zone in geo_zones %}
                                    {% if geo_zone.geo_zone_id == payment_multisafepay_dirdeb_geo_zone_id %}
                                    <option value="{{ geo_zone.geo_zone_id }}" selected="selected">{{ geo_zone.name }}</option>
                                    {% else %}
                                    <option value="{{ geo_zone.geo_zone_id }}">{{ geo_zone.name }}</option>
                                    {% endif %}
                                {% endfor %}

                            </select>
                        </div>
                    </div>

                    <!--Sorting-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-sort-order">{{ entry_sort_order }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="payment_multisafepay_dirdeb_sort_order" value="{{ payment_multisafepay_dirdeb_sort_order }}" placeholder="{{ entry_sort_order }}" id="input-sort-order" class="form-control" />
                        </div>
                    </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{ footer }}