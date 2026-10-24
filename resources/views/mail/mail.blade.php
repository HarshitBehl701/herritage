<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer Enquiry - {{ env('APP_NAME') }}</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <div style="padding: 20px;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0"
            style="max-width: 700px; margin: 0 auto; background: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">

            <!-- Header -->
            <tr>
                <td align="center"
                    style="padding: 30px 40px; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: #fff; text-align: center; border-radius: 8px 8px 0 0;">
                    <h1 style="font-size: 28px; margin: 0 0 10px 0; font-weight: 600;">New Customer Enquiry</h1>
                    <p style="font-size: 16px; margin: 0; opacity: 0.9;color:#fff !important;">
                        {{ env('APP_NAME') }}
                    </p>
                </td>
            </tr>

            <!-- Content -->
            <tr>
                <td style="padding: 30px 40px;">
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">

                        <tr>
                            <td
                                style="font-size: 20px; font-weight: 600; margin-bottom: 25px; color: #1e3c72; padding-bottom: 15px; border-bottom: 1px solid #eaeaea;">
                                Enquiry Details
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">

                                    <!-- Row 1: Name / Email -->
                                    <tr>
                                        <td width="50%" style="padding: 12px 0;">
                                            <table width="100%">
                                                <tr>
                                                    <td
                                                        style="font-weight: 600; color: #1e3c72; font-size: 14px; padding-bottom: 5px;">
                                                        Name:</td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 16px; color: #333; padding: 8px 12px; background: #f8f9fa; border-radius: 4px;">
                                                        {{ $data['name'] }}</td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td width="50%" style="padding: 12px 0 12px 15px;">
                                            <table width="100%">
                                                <tr>
                                                    <td
                                                        style="font-weight: 600; color: #1e3c72; font-size: 14px; padding-bottom: 5px;">
                                                        Email:</td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 16px; color: #333; padding: 8px 12px; background: #f8f9fa; border-radius: 4px;">
                                                        {{ $data['email'] }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <!-- Row 2: Mobile / Subject -->
                                    <tr>
                                        <td width="50%" style="padding: 12px 0;">
                                            <table width="100%">
                                                <tr>
                                                    <td
                                                        style="font-weight: 600; color: #1e3c72; font-size: 14px; padding-bottom: 5px;">
                                                        Mobile:</td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 16px; color: #333; padding: 8px 12px; background: #f8f9fa; border-radius: 4px;">
                                                        {{ $data['mobile'] }}</td>
                                                </tr>
                                            </table>
                                        </td>

                                        @if (!empty($data['subject']))
                                            <td width="50%" style="padding: 12px 0 12px 15px;">
                                                <table width="100%">
                                                    <tr>
                                                        <td
                                                            style="font-weight: 600; color: #1e3c72; font-size: 14px; padding-bottom: 5px;">
                                                            Subject:</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-size: 16px; color: #333; padding: 8px 12px; background: #f8f9fa; border-radius: 4px;">
                                                            {{ $data['subject'] }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        @else
                                            <td width="50%"></td>
                                        @endif
                                    </tr>

                                    <!-- Row 3: Service / Product -->
                                    <tr>
                                        <td width="50%" style="padding: 12px 0;">
                                            @if (!empty($data['category']))
                                                <table width="100%">
                                                    <tr>
                                                        <td
                                                            style="font-weight: 600; color: #1e3c72; font-size: 14px; padding-bottom: 5px;">
                                                            Category:</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-size: 16px; color: #333; padding: 8px 12px; background: #f8f9fa; border-radius: 4px;">
                                                            {{ $data['category'] }}</td>
                                                    </tr>
                                                </table>
                                            @endif
                                        </td>

                                        <td width="50%" style="padding: 12px 0 12px 15px;">
                                            @if (!empty($data['product']))
                                                <table width="100%">
                                                    <tr>
                                                        <td
                                                            style="font-weight: 600; color: #1e3c72; font-size: 14px; padding-bottom: 5px;">
                                                            Product:</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-size: 16px; color: #333; padding: 8px 12px; background: #f8f9fa; border-radius: 4px;">
                                                            {{ $data['product'] }}</td>
                                                    </tr>
                                                </table>
                                            @endif
                                        </td>
                                    </tr>
                                    @if (!empty($data['source']))
                                        <!-- Message -->
                                        <tr>
                                            <td colspan="2" style="padding: 12px 0;">
                                                <table width="100%">
                                                    <tr>
                                                        <td
                                                            style="font-weight: 600; color: #1e3c72; font-size: 14px; padding-bottom: 5px;">
                                                            Source:</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-size: 16px; color: #333; padding: 12px; background: #f8f9fa; border-radius: 4px; line-height: 1.5;">
                                                            {{ $data['source'] }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif

                                    @if (!empty($data['message']))
                                        <!-- Message -->
                                        <tr>
                                            <td colspan="2" style="padding: 12px 0;">
                                                <table width="100%">
                                                    <tr>
                                                        <td
                                                            style="font-weight: 600; color: #1e3c72; font-size: 14px; padding-bottom: 5px;">
                                                            Message:</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="font-size: 16px; color: #333; padding: 12px; background: #f8f9fa; border-radius: 4px; line-height: 1.5;">
                                                            {{ $data['message'] }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    @endif

                                    <!-- AUTO FIELDS (business, investment_capacity, city, state, etc.) -->
                                    @php
                                        $fields = [];
                                    @endphp

                                    @foreach ($fields as $key => $label)
                                        @if (!empty($data[$key]))
                                            <tr>
                                                <td colspan="2" style="padding: 12px 0;">
                                                    <table width="100%">
                                                        <tr>
                                                            <td
                                                                style="font-weight: 600; color: #1e3c72; font-size: 14px; padding-bottom: 5px;">
                                                                {{ $label }}:
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 16px; color: #333; padding: 12px; background: #f8f9fa; border-radius: 4px;">
                                                                @if ($key == 'resume')
                                                                    <a href="{{ $data[$key] }}" target="_blank"
                                                                        style="color:#2a5298; font-weight:600;">
                                                                        Click here to view resume
                                                                    </a>
                                                                @else
                                                                    {{ $data[$key] }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </table>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td
                    style="padding: 20px 40px; text-align: center; font-size: 14px; color: #6c757d; border-top: 1px solid #eaeaea; background-color: #f8f9fa; border-radius: 0 0 8px 8px;">
                    This email was generated automatically by
                    <span style="font-weight: 600; color: #2a5298;">{{ env('APP_NAME') }}</span>.
                    <p style="margin: 8px 0 0 0; font-size: 12px; color: #868e96;">Please do not reply to this email.
                    </p>
                </td>
            </tr>

        </table>
    </div>
</body>

</html>
