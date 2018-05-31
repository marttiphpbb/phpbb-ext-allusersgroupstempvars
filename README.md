# phpBB 3.2 PhpBB Extension - marttiphpbb All Users Groups Template Variables

This extension provides Template variables that can be used to check if the users in the views belong to certain groups.

(See also my extension [Group Template Variables](https://github.com/marttiphpbb/phpbb-ext-grouptempvars) which is for the current user only).

## Requirements

* phpBB 3.2.1+
* PHP 7+

## Examples

### Viewtopic

To check if the poster in a postrow belongs to a group:

    {%- if marttiphpbb_allusersgroupstempvars[postrow.POSTER_ID][GROUP_ID] -%}
        This content is only visible if the poster belongs to group GROUP_ID (replace GROUP_ID with the group number)
    {%- endif -%}

To get all id's of groups a poster belongs to (comma separated list):

    {%- for group_id, boolean_true in marttiphpbb_allusersgroupstempvars[postrow.POSTER_ID] -%}
        {{- group_id -}}{% if not loop.last -%}, {% endif -%}
    {%- endfor -%}

### MCP Topic Review

Same as Viewtopic. The extension adds `postrow.POSTER_ID`; it is not available from core.

### Memberlist

    {%- if marttiphpbb_allusersgroupstempvars[memberrow.USER_ID][GROUP_ID] -%}
        This content is only visible if the member belongs to group GROUP_ID (replace GROUP_ID with the group number)
    {%- endif -%}

`memberrow.USER_ID` is added by the extension; it is not available from core.

### Memberlist Profile

    {%- if marttiphpbb_allusersgroupstempvars[USER_ID][GROUP_ID] -%}
        This content is only visible if the member belongs to group GROUP_ID (replace GROUP_ID with the group number)
    {%- endif -%}

`USER_ID` is added by the extension; it is not available from core.

### Search (Results as Posts)

    {%- if marttiphpbb_allusersgroupstempvars[searchresults.POSTER_ID][GROUP_ID] -%}
        This content is only visible if the poster belongs to group GROUP_ID (replace GROUP_ID with the group number)
    {%- endif -%}

`searchresults.POSTER_ID` is added by the extension; it is not available in core.

### UCP PM Viewmessage

    {%- if marttiphpbb_allusersgroupstempvars[AUTHOR_ID][GROUP_ID] -%}
        This content is only visible if the author belongs to group GROUP_ID (replace GROUP_ID with the group number)
    {%- endif -%}

`AUTHOR_ID` is added by the extension; it is not available in core.

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
* Support requests should be posted and discussed in the [All Users Groups Template Variables topic at phpBB.com](https://www.phpbb.com/community/viewtopic.php?f=456&t=2469981).

## License

[GPL-2.0](license.txt)
