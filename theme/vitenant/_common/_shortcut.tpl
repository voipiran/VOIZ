<li>
    {if $SHORTCUT_BOOKMARKS}
        <a href="#">
            <i class="fa fa-star"></i>
            <span>{$SHORTCUT_BOOKMARKS_LABEL}</span>
        </a>
        <ul>
            {foreach from=$SHORTCUT_BOOKMARKS item=shortcut name=shortcut}
                <li>
                    <a href="index.php?menu={$shortcut.namemenu}">
                        <span>{$shortcut.name}</span>
                    </a>
                </li>
            {/foreach}
        </ul>
    {/if}
</li>

<li>
    <a href="#">
         <i class="fa fa-history"></i>
        <span>{$SHORTCUT_HISTORY_LABEL}</span>
    </a>
    <ul>
        {foreach from=$SHORTCUT_HISTORY item=shortcut}
            <li>
                <a href="index.php?menu={$shortcut.namemenu}">
                    <span>{$shortcut.name}</span>
                </a>
            </li>
        {/foreach}
    </ul>
</li>