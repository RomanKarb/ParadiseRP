import discord
from discord.ext import commands

intents = discord.Intents.default()
intents.messages = True
intents.reactions = True

bot = commands.Bot(command_prefix='!', intents=intents)

@bot.event
async def on_ready():
    guild_id = 1123971136611422210
    channel_id = 1124211118513066004
    guild = bot.get_guild(guild_id)
    channel = guild.get_channel(channel_id)
    
    message = await channel.send('Выберите роль пожалуйста')
    await message.add_reaction('❤️')  # Реакция :heart:
    await message.add_reaction('🔥')  # Реакция :fire:

bot.run('MTEyNTgwMTY1MTQ1OTA3MjExMA.GXGgbR.HP2hbrx7VhC1ZcmjmYD8OTohPoXPzW_oxjFEdk')