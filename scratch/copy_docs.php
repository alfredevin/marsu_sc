<?php
$readme = shell_exec('git show backup/group8a-work:modules/retention/README.md');
$readme = str_replace(['modules/retention', 'retention', 'Retention', 'ret_'], ['modules/analytics', 'analytics', 'Analytics', 'ana_'], $readme);
file_put_contents('modules/analytics/README.md', $readme);

$spams = shell_exec('git show backup/group8a-work:modules/retention/SPAMS_DIRECTORY.md');
$spams = str_replace(['modules/retention', 'retention', 'Retention', 'ret_'], ['modules/analytics', 'analytics', 'Analytics', 'ana_'], $spams);
file_put_contents('modules/analytics/SPAMS_DIRECTORY.md', $spams);

if (!is_dir('modules/analytics/docs')) { 
    mkdir('modules/analytics/docs', 0777, true); 
}
$p1 = shell_exec('git show backup/group8a-work:modules/retention/docs/PROMPT_gemini_role_based_portals.md');
file_put_contents('modules/analytics/docs/PROMPT_gemini_role_based_portals.md', $p1);
$p2 = shell_exec('git show backup/group8a-work:modules/retention/docs/PROMPT_role_based_portals.md');
file_put_contents('modules/analytics/docs/PROMPT_role_based_portals.md', $p2);

echo "Docs copied and adapted successfully\n";
