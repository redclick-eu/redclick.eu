<?php

namespace App;

class Breadcrumbs {

    public $arg;

    static $l10n = [];

    static $args = array(
        'on_front_page'   => true,
        'show_post_title' => true,
        'show_term_title' => true,
        'title_patt'      => '<span class="breadcrumbs-title">%s<meta itemprop="position" content="$$pos$$" /></span>',
        'last_sep'        => true,
        'markup'          => 'schema.org',
        'priority_tax'    => array('category'),
        'priority_terms'  => array(),
        'nofollow' => false,
        'sep'             => '',
        'linkpatt'        => '',
        'pg_end'          => '',
    );

    public function __construct() {
        self::$l10n = array(
            'home'       => wpcl_t('Home page'),
            'paged'      => wpcl_t('Page %d'),
            '_404'       => '<span>' . wpcl_t('Error 404') . '</span>',
            'search'     => '<span>' . wpcl_t('Search results for the query - <b>%s</b>') . '</span>',
            'author'     => 'Author\'s archive: <b>%s</b>',
            'year'       => 'Archive <b>%d</b> год',
            'month'      => 'Archive: <b>%s</b>',
            'day'        => '',
            'attachment' => 'Media: %s',
            'tag'        => 'Tag\'s posts: <b>%s</b>',
            'tax_tag'    => '%1$s from "%2$s" by tag: <b>%3$s</b>',
        );
    }

    function get_crumbs( $sep, $l10n, $args ){
        global $post, $wp_query, $wp_post_types;

        self::$args['sep'] = $sep;

        $loc = (object) array_merge( apply_filters('breadcrumbs_default_loc', self::$l10n ), $l10n );
        $arg = (object) array_merge( apply_filters('_breadcrumbs_default_args', self::$args ), $args );

        $arg->sep = '<span class="breadcrumbs-sep">'. $arg->sep .'</span>';

        $sep = & $arg->sep;
        $this->arg = & $arg;

        if(1){
            $mark = & $arg->markup;

            if( ! $mark ) $mark = array(
                'type' =>  'default',
                'wrappatt'  => '<div class="breadcrumbs-container">%s</div>',
                'linkpatt'  => '<a href="%s">%s</a>',
                'sep_after' => '',
            );
            elseif( $mark === 'rdf.data-vocabulary.org' ) $mark = array(
                'type' =>  'rdf.data-vocabulary.org',
                'wrappatt'   => '<div class="breadcrumbs-container" prefix="v: http://rdf.data-vocabulary.org/#">%s</div>',
                'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
                'sep_after'  => '</span>',
            );

            elseif( $mark === 'schema.org' ) $mark = array(
                'type' =>  'schema.org',
                'wrappatt'   => '<div class="breadcrumbs-container" itemscope itemtype="http://schema.org/BreadcrumbList">%s</div>',
                'linkpatt'   => '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%s" itemprop="item"><span itemprop="name">%s</span></a><meta itemprop="position" content="$$pos$$" /></span>',
                'sep_after'  => '',
            );
            elseif( ! is_array($mark) )
                die( __CLASS__ .': "markup" parameter must be array...');

            $wrappatt  = $mark['wrappatt'];
            $arg->linkpatt  = $arg->nofollow ? str_replace('<a ','<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
            $arg->sep      .= $mark['sep_after']."\n";
        }

        $linkpatt = $arg->linkpatt;

        $q_obj = get_queried_object();

        $ptype = null;
        if( empty($post) ){
            if( isset($q_obj->taxonomy) )
                $ptype = & $wp_post_types[ get_taxonomy($q_obj->taxonomy)->object_type[0] ];
        }
        else $ptype = & $wp_post_types[ $post->post_type ];

        $arg->pg_end = '';
        if( ($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')) )
            $arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );

        $pg_end = $arg->pg_end;

        $out = '';

        if( is_front_page() ){
            return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home, 1) . $pg_end : $loc->home ) ) : '';
        }
        elseif( is_home() ) {
            $out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title), 1 ) . $pg_end ) : esc_html($q_obj->post_title);
        }
        elseif( is_404() ){
            $out = $loc->_404;
        }
        elseif( is_search() ){
            $out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
        }
        elseif( is_author() ){
            $tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
            $out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit, 1) : $tit );
        }
        elseif( is_year() || is_month() || is_day() ){
            $y_url  = get_year_link( $year = get_the_time('Y') );

            if( is_year() ){
                $tit = sprintf( $loc->year, $year );
                $out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit, 1) . $pg_end : $tit );
            }
            else {
                $y_link = sprintf( $linkpatt, $y_url, $year, 1);
                $m_url  = get_month_link( $year, get_the_time('m') );

                if( is_month() ){
                    $tit = sprintf( $loc->month, get_the_time('F') );
                    $out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit, 1 ) . $pg_end : $tit );
                }
                elseif( is_day() ){
                    $m_link = sprintf( $linkpatt, $m_url, get_the_time('F'), 1);
                    $out = $y_link . $sep . $m_link . $sep . get_the_time('l');
                }
            }
        }
        elseif( is_singular() && $ptype->hierarchical ){
            $out = $this->_add_title( $this->_page_crumbs($post), $post );
        }
        else {
            $term = $q_obj;

            if( is_singular() ){
                if( is_attachment() && $post->post_parent ){
                    $save_post = $post;
                    $post = get_post($post->post_parent);
                }

                $taxonomies = get_object_taxonomies( $post->post_type );
                $taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

                if( $taxonomies ){
                    if( ! empty($arg->priority_tax) ){
                        usort( $taxonomies, function($a,$b)use($arg){
                            $a_index = array_search($a, $arg->priority_tax);
                            if( $a_index === false ) $a_index = 9999999;

                            $b_index = array_search($b, $arg->priority_tax);
                            if( $b_index === false ) $b_index = 9999999;

                            return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 );
                        } );
                    }

                    foreach( $taxonomies as $taxname ){
                        if( $terms = get_the_terms( $post->ID, $taxname ) ){
                            $prior_terms = & $arg->priority_terms[ $taxname ];
                            if( $prior_terms && count($terms) > 2 ){
                                foreach( (array) $prior_terms as $term_id ){
                                    $filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
                                    $_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

                                    if( $_terms ){
                                        $term = array_shift( $_terms );
                                        break;
                                    }
                                }
                            }
                            else
                                $term = array_shift( $terms );

                            break;
                        }
                    }
                }

                if( isset($save_post) ) $post = $save_post;
            }

            if( $term && isset($term->term_id) ){
                $term = apply_filters('breadcrumbs_term', $term );

                if( is_attachment() ){
                    if( ! $post->post_parent )
                        $out = sprintf( $loc->attachment, esc_html($post->post_title) );
                    else {
                        if( ! $out = apply_filters('attachment_tax_crumbs', '', $term, $this ) ){
                            $_crumbs    = $this->_tax_crumbs( $term, 'self' );
                            $parent_tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent), 1 );
                            $_out = implode( $sep, array($_crumbs, $parent_tit) );
                            $out = $this->_add_title( $_out, $post );
                        }
                    }
                }

                elseif( is_single() ){
                    if( ! $out = apply_filters('post_tax_crumbs', '', $term, $this ) ){
                        $_crumbs = $this->_tax_crumbs( $term, 'self' );
                        $out = $this->_add_title( $_crumbs, $post );
                    }
                }
                elseif( ! is_taxonomy_hierarchical($term->taxonomy) ){
                    if( is_tag() )
                        $out = $this->_add_title('', $term, sprintf( $loc->tag, esc_html($term->name) ) );
                    elseif( is_tax() ){
                        $post_label = $ptype->labels->name;
                        $tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
                        $out = $this->_add_title('', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html($term->name) ) );
                    }
                }
                else {
                    if( ! $out = apply_filters('term_tax_crumbs', '', $term, $this ) ){
                        $_crumbs = $this->_tax_crumbs( $term, 'parent' );
                        $out = $this->_add_title( $_crumbs, $term, esc_html($term->name) );
                    }
                }
            }
            elseif( is_attachment() ){
                $parent = get_post($post->post_parent);
                $parent_link = sprintf( $linkpatt, get_permalink($parent), esc_html($parent->post_title),1 );
                $_out = $parent_link;

                if( is_post_type_hierarchical($parent->post_type) ){
                    $parent_crumbs = $this->_page_crumbs($parent);
                    $_out = implode( $sep, array( $parent_crumbs, $parent_link ) );
                }

                $out = $this->_add_title( $_out, $post );
            }
            elseif( is_singular() ){
                $out = $this->_add_title( '', $post );
            }
        }

        $home_after = apply_filters('breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

        if( '' === $home_after ){
            if( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
                && ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
            ){
                $pt_title = $ptype->labels->name;

                if( is_post_type_archive() && ! $paged_num )
                    $home_after = sprintf( $this->arg->title_patt, $pt_title );
                else{
                    $home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

                    $home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep );
                }
            }
        }

        $before_out = sprintf( $linkpatt, home_url(), $loc->home, 1 ) . ( $home_after ? $sep.$home_after : ($out ? $sep : '') );

        $out = apply_filters('breadcrumbs_pre_out', $out, $sep, $loc, $arg );

        $out = sprintf( $wrappatt, $before_out . $out );

        if($arg->markup['type'] === 'schema.org') {
            $i = 1;
            while (strpos($out, '$$pos$$') !== false && $i < 10000) {
                $out = preg_replace('/\$\$pos\$\$/', $i++, $out, 1);
            }
        }

        return apply_filters('breadcrumbs', $out, $sep, $loc, $arg );
    }

    function _page_crumbs( $post ){
        $parent = $post->post_parent;

        $crumbs = array();
        while( $parent ){
            $page = get_post( $parent );
            $crumbs[] = sprintf( $this->arg->linkpatt, get_permalink($page), esc_html($page->post_title) );
            $parent = $page->post_parent;
        }

        return implode( $this->arg->sep, array_reverse($crumbs) );
    }

    function _tax_crumbs( $term, $start_from = 'self' ){
        $termlinks = array();
        $term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
        while( $term_id ){
            $term       = get_term( $term_id, $term->taxonomy );
            $termlinks[] = sprintf( $this->arg->linkpatt, get_term_link($term), esc_html($term->name) );
            $term_id    = $term->parent;
        }

        if( $termlinks )
            return implode( $this->arg->sep, array_reverse($termlinks) ) /*. $this->arg->sep*/;
        return '';
    }

    function _add_title( $add_to, $obj, $term_title = '' ){
        $arg = & $this->arg;
        $title = $term_title ? $term_title : esc_html($obj->post_title);
        $show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

        if( $arg->pg_end ){
            $link = $term_title ? get_term_link($obj) : get_permalink($obj);
            $add_to .= ($add_to ? $arg->sep : '') . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
        }

        elseif( $add_to ){
            if( $show_title )
                $add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
            elseif( $arg->last_sep )
                $add_to .= $arg->sep;
        }

        elseif( $show_title )
            $add_to = sprintf( $arg->title_patt, $title );

        return $add_to;
    }

}
