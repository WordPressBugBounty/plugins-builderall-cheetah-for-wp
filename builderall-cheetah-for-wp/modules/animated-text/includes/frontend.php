<?php
$node_id = "ba-node-$id";
?>

<div class="ba-module__animated-text ba-cheetah-node-<?php echo $node_id; ?>">
    <h2>
        <?php
        foreach ($settings->items as $key => $item) :


            if ($item->type == 'words'):
                echo '<div class="hasEffect hasEffect-' . $key . ' ' . esc_attr($item->effect) . '">';

                foreach ($item->text_items as $subItem):
                    echo '<span style="color:' . BACheetahColor::hex_or_rgb($item->color) . '">' . json_decode($subItem)->text . '</span>';
                endforeach;

                echo '</div>';

            else:
                if ($item->type == 'disabled' || $item->effect == 'none'):
                    echo '<div style="color:' . BACheetahColor::hex_or_rgb($item->color) . '">';
                    echo esc_html($item->text);
                    echo '</div>';

                else:
                    echo '<div class="hasEffect hasEffect-' . $key . ' ' . esc_attr($item->effect) . '" style="color:' . esc_attr(BACheetahColor::hex_or_rgb($item->color)) . '">';
                    echo '<span>' . esc_html($item->text) . '</span>';
                    echo '<span>' . esc_html($item->text) . '</span>';
                    echo '<span>' . esc_html($item->text) . '</span>';
                    echo '<span>' . esc_html($item->text) . '</span>';
                    echo '<span>' . esc_html($item->text) . '</span>';
                    echo '</div>';
                endif;
            endif;

        endforeach; ?>
    </h2>
</div>

