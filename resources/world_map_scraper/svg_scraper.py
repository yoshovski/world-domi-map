import os
import re

# Read HTML source from a file
html_file = r'C:\Users\stefa\Coding\Web\htdocs\wordpress\wp-content\plugins\world-domi-map\resources\world_map_scraper\svg_web.html'

with open(html_file, 'r') as file:
    html_source = file.read()

# Combine <path> and </path> tags into a single line
html_source = re.sub(r'>\s*\n\s*</path>', '></path>', html_source)

# Regular expression patterns to extract country information
pattern1 = r'<path\s(?:class="(.*?)".*?)d="(.*?)".*?></path>'
pattern2 = r'<path\s.*?d="(.*?)".*?name="(.*?)".*?></path>'

# Find all matches with Pattern 1
matches = re.findall(pattern1, html_source, re.DOTALL)

# Create a dictionary to store country paths
country_paths = {}

# Process each match from Pattern 1
for match in matches:
    class_name, path = match
    name = re.search(r'name="(.*?)"', match[0])
    if class_name:
        country = class_name
    elif name:
        country = name.group(1).strip()
    else:
        continue

    if country in country_paths:
        # Concatenate multiple paths for the same country
        country_paths[country] += '\n' + path
    else:
        country_paths[country] = path

# Find all matches with Pattern 2
matches2 = re.findall(pattern2, html_source, re.DOTALL)

# Process each match from Pattern 2
for match2 in matches2:
    path, name = match2
    if name:
        country = name.strip()
        if country in country_paths:
            # Concatenate multiple paths for the same country
            country_paths[country] += '\n' + path
        else:
            country_paths[country] = path

# List of countries
countries = [
            'Afghanistan',
            'Albania',
            'Algeria',
            'Andorra',
            'Angola',
            'Antigua and Barbuda',
            'Argentina',
            'Armenia',
            'Australia',
            'Austria',
            'Azerbaijan',
            'Bahamas',
            'Bahrain',
            'Bangladesh',
            'Barbados',
            'Belarus',
            'Belgium',
            'Belize',
            'Benin',
            'Bhutan',
            'Bolivia',
            'Bosnia and Herzegovina',
            'Botswana',
            'Brazil',
            'Brunei',
            'Bulgaria',
            'Burkina Faso',
            'Burundi',
            'Cabo Verde',
            'Cambodia',
            'Cameroon',
            'Canada',
            'Central African Republic',
            'Chad',
            'Chile',
            'China',
            'Colombia',
            'Comoros',
            'Congo',
            'Costa Rica',
            'Croatia',
            'Cuba',
            'Cyprus',
            'Czechia',
            'Denmark',
            'Djibouti',
            'Dominica',
            'Dominican Republic',
            'East Timor',
            'Ecuador',
            'Egypt',
            'El Salvador',
            'Equatorial Guinea',
            'Eritrea',
            'Estonia',
            'Eswatini',
            'Ethiopia',
            'Fiji',
            'Finland',
            'France',
            'Gabon',
            'Gambia',
            'Georgia',
            'Germany',
            'Ghana',
            'Greece',
            'Grenada',
            'Guatemala',
            'Guinea',
            'Guinea-Bissau',
            'Guyana',
            'Haiti',
            'Honduras',
            'Hungary',
            'Iceland',
            'India',
            'Indonesia',
            'Iran',
            'Iraq',
            'Ireland',
            'Israel',
            'Italy',
            'Jamaica',
            'Japan',
            'Jordan',
            'Kazakhstan',
            'Kenya',
            'Kiribati',
            'Korea, North',
            'Korea, South',
            'Kosovo',
            'Kuwait',
            'Kyrgyzstan',
            'Laos',
            'Latvia',
            'Lebanon',
            'Lesotho',
            'Liberia',
            'Libya',
            'Liechtenstein',
            'Lithuania',
            'Luxembourg',
            'Madagascar',
            'Malawi',
            'Malaysia',
            'Maldives',
            'Mali',
            'Malta',
            'Marshall Islands',
            'Mauritania',
            'Mauritius',
            'Mexico',
            'Micronesia',
            'Moldova',
            'Monaco',
            'Mongolia',
            'Montenegro',
            'Morocco',
            'Mozambique',
            'Myanmar',
            'Namibia',
            'Nauru',
            'Nepal',
            'Netherlands',
            'New Zealand',
            'Nicaragua',
            'Niger',
            'Nigeria',
            'North Macedonia',
            'Norway',
            'Oman',
            'Pakistan',
            'Palau',
            'Panama',
            'Papua New Guinea',
            'Paraguay',
            'Peru',
            'Philippines',
            'Poland',
            'Portugal',
            'Qatar',
            'Romania',
            'Russia',
            'Rwanda',
            'Saint Kitts and Nevis',
            'Saint Lucia',
            'Saint Vincent and the Grenadines',
            'Samoa',
            'San Marino',
            'Sao Tome and Principe',
            'Saudi Arabia',
            'Senegal',
            'Serbia',
            'Seychelles',
            'Sierra Leone',
            'Singapore',
            'Slovakia',
            'Slovenia',
            'Solomon Islands',
            'Somalia',
            'South Africa',
            'South Sudan',
            'Spain',
            'Sri Lanka',
            'Sudan',
            'Suriname',
            'Sweden',
            'Switzerland',
            'Syria',
            'Taiwan',
            'Tajikistan',
            'Tanzania',
            'Thailand',
            'Togo',
            'Tonga',
            'Trinidad and Tobago',
            'Tunisia',
            'Turkey',
            'Turkmenistan',
            'Tuvalu',
            'Uganda',
            'Ukraine',
            'United Arab Emirates',
            'United Kingdom',
            'United States',
            'Uruguay',
            'Uzbekistan',
            'Vanuatu',
            'Vatican City',
            'Venezuela',
            'Vietnam',
            'Yemen',
            'Zambia',
            'Zimbabwe'
]

# Add countries with blank values if no matching path is found
for country in countries:
    if country not in country_paths:
        country_paths[country] = ''

# Create the output string
output = ''
for country, path in country_paths.items():
    output += f"'{country}' => '{path}',\n"

# Get the directory path of the current script
script_directory = os.path.dirname(os.path.abspath(__file__))

# Save output to a text file in the current directory
output_filename = os.path.join(script_directory, 'output.txt')

with open(output_filename, 'w') as file:
    file.write(output)

print(f"Output saved to {output_filename}")
