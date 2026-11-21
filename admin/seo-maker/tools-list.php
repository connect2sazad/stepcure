<!-- Heading -->
<h4 class="fw-bold py-3 mb-4">SEO Maker 2.6</h4>

<div class="row mb-4">
    <?php

    $hidden_tools = array("tool3");

    $scan_tools = scandir(__SEO_MAKER_TOOLS___);
    foreach ($scan_tools as $tool) {
        if ($tool == '.' || $tool == '..' || in_array($tool, $hidden_tools)) {
            continue;
        } else {
            $tool_path = __SEO_MAKER_TOOLS___ . $tool;
            if (file_exists($tool_path . "/config.json")) {
                $tool_config = "tools/" . $tool . "/config.json";
                $tool_config = file_get_contents($tool_config);
                if (json_validator($tool_config)) {
                    $tool_config = json_decode($tool_config, true);

                    // get parent tool buttons
                    $action_buttons = $tool_config['action_buttons'];
                    $parent_buttons = get_tool_buttons($action_buttons);

                    // get the parent tool
                    if (array_key_exists('hidden', $tool_config) && $tool_config['hidden']) {
                    } else {
                        echo '
                        <div class="col-12 col-sm-6 col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="mb-3 ' . $tool_config['icon'] . '"></i>
                                    <h5>' . $tool_config['tool'] . '</h5>
                                    <p> ' . $tool_config['short_description'] . ' </p>
                                    ' . $parent_buttons . '
                                </div>
                            </div>
                        </div>
                    ';
                    }

                    // get the sub tools list
                    if (array_key_exists('sub_tools', $tool_config)) {
                        $sub_tools = $tool_config['sub_tools'];
                        for ($index = 0; $index < count($sub_tools); $index++) {
                            $sub_tool = $sub_tools[$index];

                            if (array_key_exists('hidden', $sub_tool) &&  $sub_tool['hidden']) {
                                continue;
                            }

                            // get sub tool buttons
                            $action_buttons = $sub_tool['action_buttons'];
                            $sub_tool_buttons = get_tool_buttons($action_buttons);

                            echo '
                                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <i class="mb-3 ' . $sub_tool['icon'] . '"></i>
                                            <h5>' . $sub_tool['tool'] . '</h5>
                                            <p> ' . $sub_tool['short_description'] . ' </p>
                                            ' . $sub_tool_buttons . '
                                        </div>
                                    </div>
                                </div>
                    ';
                        }
                    }
                } else {
                    // do nothing
                    // reserved for future
                }
            }
        }
    }

    ?>

</div>