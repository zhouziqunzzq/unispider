# API DOC

## Web Front-end Interface

### Get Twitters

**Get /api/tweets/ HTTP/1.1**

<table>
    <tr>
        <th>Key</th>
        <th>Example Value</th>
        <th>Comment</th>
    </tr>
    <tr>
        <td>pwd</td>
        <td>apikey</td>
        <td>API Key, set in .env</td>
    </tr>
    <tr>
        <td>date</td>
        <td>2017-04-16</td>
        <td>The last date of the twitters</td>
    </tr>
    <tr>
        <td>offset</td>
        <td>0</td>
        <td>Skip a number of twitters</td>
    </tr>
</table>