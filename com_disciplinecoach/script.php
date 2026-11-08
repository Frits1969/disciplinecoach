<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla Component
 * ========================================================================
 *
 * File        : script.php
 * Path        : script.php
 * Purpose     : Installation and update script.
 *               Ensures required media folders and default assets
 *               are deployed automatically during install and update.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-07
 * Modified    : 2026-11-08
 * Version     : 0.1.2
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

defined('_JEXEC') or die;

use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;

class Com_DisciplineCoachInstallerScript implements InstallerScriptInterface
{
    /**
     * Executes before install, update or discover_install.
     *
     * @param   string            $type    The action being performed
     * @param   InstallerAdapter  $parent  The installer adapter
     *
     * @return  bool
     */
    public function preflight(string $type, InstallerAdapter $parent): bool
    {
        return true;
    }

    /**
     * Executes on fresh install.
     *
     * @param   InstallerAdapter  $parent  The installer adapter
     *
     * @return  bool
     */
    public function install(InstallerAdapter $parent): bool
    {
        return true;
    }

    /**
     * Executes on extension update.
     *
     * @param   InstallerAdapter  $parent  The installer adapter
     *
     * @return  bool
     */
    public function update(InstallerAdapter $parent): bool
    {
        return true;
    }

    /**
     * Executes on extension uninstall.
     *
     * @param   InstallerAdapter  $parent  The installer adapter
     *
     * @return  bool
     */
    public function uninstall(InstallerAdapter $parent): bool
    {
        // Best practice: Do NOT delete user media on uninstall to prevent data loss.
        return true;
    }

    /**
     * Executes after install, update or discover_install.
     *
     * @param   string            $type    The action being performed
     * @param   InstallerAdapter  $parent  The installer adapter
     *
     * @return  bool
     */
    public function postflight(string $type, InstallerAdapter $parent): bool
    {
        if ($type !== 'uninstall')
        {
            $this->setupDisciplineMedia();
        }

        return true;
    }

    protected function setupDisciplineMedia(): void
    {
        $targetDir = JPATH_ROOT . '/images/disciplines';

        if (!is_dir($targetDir))
        {
            mkdir($targetDir, 0755, true);
        }

        $indexFile = $targetDir . '/index.html';

        if (!file_exists($indexFile))
        {
            file_put_contents(
                $indexFile,
                '<!DOCTYPE html><html><body></body></html>'
            );
        }
    }

}

return new Com_DisciplineCoachInstallerScript();
