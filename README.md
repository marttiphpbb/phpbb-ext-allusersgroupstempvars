# phpBB 3.2 PhpBB Extension - marttiphpbb All Users Groups Template Variables

This extension adds provides you a Template array with all the groups of the users in the context of the current template.

## Examples

Check if the user is in a certain group (in viewtopic):

    {%- if marttiphpbb_allusersgroupstempvars[postrow.POSTER_ID][5] -%}
        This postrow is in group 5
    {%- endif -%}

Sum up all the groups a user is member of (in viewtopic):

    {%- for group_name in marttiphpbb_allusersgroupstempvars[postrow.POSTER_ID] -%}
        {{- group_name}}
    {%- endfor -%}

## Quick Install

You can install this on the latest release of phpBB 3.2 by following the steps below:

* Create `marttiphpbb/allusersgroupstempvars` in the `ext` directory.
* Download and unpack the repository into `ext/marttiphpbb/allusersgroupstempvars`
* Enable `All Users Groups Template Variables` in the ACP at `Customise -> Manage extensions`.

## Uninstall

* Disable `All Users Groups Template Variables` in the ACP at `Customise -> Extension Management -> Extensions`.
* To permanently uninstall, click `Delete Data`.  Optionally delete the `/ext/marttiphpbb/allusersgroupstempvars` directory.

## Support

* Report bugs and other issues to the [Issue Tracker](https://github.com/marttiphpbb/phpbb-ext-allusersgroupstempvars/issues).
* Support requests should be posted and discussed in the [All Users Groups Template Variables topic at phpBB.com](https://www.phpbb.com/community/viewtopic.php?f=456&t=). (Yet to be created)

#### License

[GPL-2.0](license.txt)
