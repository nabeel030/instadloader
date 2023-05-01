import instaloader
import urllib.parse
import codecs
import sys

sys.stdout.reconfigure(encoding='utf-8')

# Create an instance of Instaloader class
L = instaloader.Instaloader()

# Login to your account (optional)
# L.context.login("<your_username>", "<your_password>")

# Define the URL of the Reel you want to download
url = sys.argv[1]
url = url.encode('utf-8').decode('ascii', 'ignore')

# Get the Reel metadata
shortcode = url.split("/")[-2]
reel = instaloader.Post.from_shortcode(L.context, shortcode)
video_url = reel.video_url
print(video_url)
# return "It worked"
# Download the Reel
# L.download_post(reel, target="#download/")